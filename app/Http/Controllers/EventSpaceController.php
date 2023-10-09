<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EventSpace;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use App\Mail\NewEventMail;
use App\Models\Department;
use Illuminate\Support\Facades\Mail;

class EventSpaceController extends Controller
{
    public function index() {

        // Paso 1: Obtener el ID del departamento del usuario autenticado
        $usuarioDepartamentoId = Auth::user()->team->department_id;        

        // Paso 2: Obtener todos los eventos solicitados del departamento del usuario
        $events = Event::join('event_spaces', 'events.id', '=', 'event_spaces.event_id')
            ->join('spaces', 'event_spaces.space_id', '=', 'spaces.id')
            ->where('spaces.department_id', $usuarioDepartamentoId)
            ->where('events.status', 'solicitado')
            ->select('events.*') // Seleccionar todos los campos de la tabla events
            ->get();
       

        // $eventosFiltrados ahora contiene la lista de eventos que cumplen con las condiciones


        // $events=EventSpace::where('status','solicitado')->get();
        // Obtengo el departamento al que esta asociado el usuario en la tabla Teams
        // $user = Auth::user();
        // $department_id = $user->team->department_id;

        // Obtención de la lista de eventos cuyo espacio pertenezca al departamento identificado        
        // $events = EventSpace::where('status', 'solicitado')
        //             ->whereHas('event', function ($query) use ($department_id) {
        //                 $query->where('department_id', $department_id);
        //             })
        //             ->get();

        // $events = Event::whereHas('spaces', function ($query) use ($department_id) {
        //     $query->where('department_id', $department_id);
        // })->whereHas('spaces.eventSpaces', function ($query) {
        //     $query->where('status', 'solicitado');
        // })->get();

        //return $events;

        return view('eventspaces.index',compact('events'));
    }

    public function authorizeRequestSpace(Event $event)
    {
        $user=Auth::user();
        $eventSpace = EventSpace::where('event_id', $event->id)->first();
        $eventSpace->status = 'aceptado';
        $eventSpace->validate_by=$user->id;
        $eventSpace->save();

        $event->published=1;
        $event->status='finalizado';
        $event->save();

        // Obtén el usuario autenticado
        $user = Auth::user();

        // Notificaciones para anunciar que se ha publicado un nuevo evento
        $emailList = ['augarued@unam.mx', 'alejandramireles@psicologia.unam.mx','publicaciones.psicologia@unam.mx'];
        $mail = new NewEventMail($event, $emailList);
        Mail::to($user)->send($mail);

        return redirect()->back()->with('success', 'La solicitud ha sido autorizada.');
    }

    public function rejectRequestSpace(Request $request, Event $event)
    {
        $user=Auth::user();
        $eventSpace = EventSpace::where('event_id', $event->id)->first();
        $eventSpace->status = 'rechazado';
        $eventSpace->observation = $request->input('observation');
        $eventSpace->save();
        $eventSpace->validate_by=$user->id;

        $event->status='finalizado';
        $event->save();

        return redirect()->back()->with('success', 'La solicitud ha sido rechazada.');
    }

}
