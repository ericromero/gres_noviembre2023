<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EventSpace;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use App\Mail\NewEventMail;
use Illuminate\Support\Facades\Mail;

class EventSpaceController extends Controller
{
    public function index() {
        $events=EventSpace::where('status','solicitado')->get();
        // Obtengo el departamento al que esta asociado el usuario en la tabla Teams
        $user = Auth::user();
        $department_id = $user->team->department_id;
        // Obtención de la lista de eventos cuyo espacio pertenezca al departamento identificado        
        $events = EventSpace::where('status', 'solicitado')
                    ->whereHas('event', function ($query) use ($department_id) {
                        $query->where('department_id', $department_id);
                    })
                    ->get();

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
