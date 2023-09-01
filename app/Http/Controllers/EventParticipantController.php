<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventParticipant;

class EventParticipantController extends Controller
{
    public function storeParticipant(Request $request)
    {
        $event_id=$request->event_id;
        $validatedData = $request->validate([
            'fullname' => 'required|string',
            'participation_type_id' => 'required|integer',
            'event_id' => 'required|integer',
            'user_id' => 'nullable|integer',
        ]);

        EventParticipant::create($validatedData);

        return redirect()->route('events.participants',$event_id)->with('success', 'Participante registrado exitosamente.');
    }

    public function destroy(EventParticipant $participant)
    {   $event_id=$participant->event_id;
        $participant->delete();

        return redirect()->route('events.participants',$event_id)->with('success', 'Participante borrado exitosamente.');
    }
}
