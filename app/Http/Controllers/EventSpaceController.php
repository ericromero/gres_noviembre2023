<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EventSpace;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class EventSpaceController extends Controller
{
    public function index() {
        $events=EventSpace::where('status','solicitado')->get();
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
