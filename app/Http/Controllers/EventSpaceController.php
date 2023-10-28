<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EventSpace;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use App\Mail\UnauthorizeEventMail;
use App\Mail\authorizeEventMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class EventSpaceController extends Controller
{
    public function index() {

        // Paso 1: Obtener el ID del departamento del usuario autenticado
        $usuarioDepartamentoId = Auth::user()->team->department_id;        

        // Paso 2: Obtener todos los eventos solicitados del departamento del usuario
        $events = Event::join('event_spaces', 'events.id', '=', 'event_spaces.event_id')
            ->join('spaces', 'event_spaces.space_id', '=', 'spaces.id')
            ->where('spaces.department_id', $usuarioDepartamentoId)
            ->whereNot('events.status', 'borrador')
            ->select('events.*') // Seleccionar todos los campos de la tabla events
            ->paginate(8);

        return view('eventspaces.index',compact('events'));
    }

    public function awaitingRequests() {

        // Paso 1: Obtener el ID del departamento del usuario autenticado
        $usuarioDepartamentoId = Auth::user()->team->department_id;        

        // Paso 2: Obtener todos los eventos solicitados del departamento del usuario
        $events = Event::join('event_spaces', 'events.id', '=', 'event_spaces.event_id')
            ->join('spaces', 'event_spaces.space_id', '=', 'spaces.id')
            ->where('spaces.department_id', $usuarioDepartamentoId)
            ->where('events.status', 'solicitado')
            ->select('events.*') // Seleccionar todos los campos de la tabla events
            ->paginate();

        return view('eventspaces.index',compact('events'));
    }

    public function authorizeRequestSpace(Event $event)
    {
        // Verificando que la solicitud esté pendiente
        if($event->status!='solicitado') {
            return redirect()->route('event_spaces.review')->with('error', 'Acceso ilegal, la solicitud ha habia sido atendida.');
        }

        $user=Auth::user();        
        $eventSpace = EventSpace::where('event_id', $event->id)->first();
        $eventSpace->status = 'aceptado';
        $eventSpace->validate_by=$user->id;
        $eventSpace->save();

        $event->status='finalizado';
        $event->save();

        // Bloque para envío de notificación
        $responsible = User::find($event->responsible_id);
        $userDepartmentId = $user->team->department_id;

        // Obtener la lista de correos electrónicos de usuarios en el mismo departamento
        $emailList = User::join('teams', 'users.id', '=', 'teams.user_id')
            ->where('teams.department_id', $userDepartmentId)
            ->pluck('email');

        // Se notifica al responsable sobre el rechazo del préstamo
        $mail = new authorizeEventMail($event,$emailList);
        Mail::to($responsible)->send($mail);

        return redirect()->route('event_spaces.review')->with('success', 'La solicitud ha sido autorizada.');
    }

    public function preRejectRequestSpace(Event $event) {
        // Verificando que la solicitud esté pendiente
        if($event->status!='solicitado') {
            return redirect()->route('event_spaces.review')->with('error', 'Acceso ilegal, la solicitud ha habia sido atendida.');
        }

        return view('eventspaces.reject',compact('event'));
    }

    public function rejectRequestSpace(Request $request)
    {       
        $request->validate([
            'observation' => 'required|min:100|max:2000',
        ], [
            'observation.required' => 'El campo observación es obligatorio.',
            'observation.min' => 'El campo observación debe tener al menos :min caracteres.',
            'observation.max' => 'El campo observación no puede tener más de :max caracteres.',
        ]);

        $user=Auth::user();
        $event=Event::find($request->event);

        // Verificando que la solicitud esté pendiente
        if($event->status!='solicitado') {
            return redirect()->route('event_spaces.review')->with('error', 'Acceso ilegal, la solicitud ha habia sido atendida.');
        }
        
        $reason=$request->input('observation');
        
        $eventSpace = EventSpace::where('event_id', $event->id)->first();
        $eventSpace->status = 'rechazado';
        $eventSpace->observation =$reason;  
        $eventSpace->validate_by=$user->id;
        $eventSpace->save();

        $event->status='finalizado';
        $event->save();

        // Bloque para envío de notificación
        $responsible = User::find($event->responsible_id);
        $userDepartmentId = $user->team->department_id;

        // Obtener la lista de correos electrónicos de usuarios en el mismo departamento
        $emailList = User::join('teams', 'users.id', '=', 'teams.user_id')
            ->where('teams.department_id', $userDepartmentId)
            ->pluck('email');

        // Se notifica al responsable sobre el rechazo del préstamo
        $mail = new UnauthorizeEventMail($event,$reason,$emailList);
        Mail::to($responsible)->send($mail);        

        return redirect()->route('event_spaces.review')->with('success', 'La solicitud ha sido rechazada.');
    }

}
