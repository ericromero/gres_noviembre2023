<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventParticipant;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class EventParticipantController extends Controller
{
    public function storeParticipant(Request $request)
    {
        $event_id=$request->event_id;

        $rules = [
            'fullname' => [
                'required',
                'string',
                ],
            'participation_type_id' => [
                'required',
                'integer'],
            'event_id' => [
                'required',
                'integer'],
        ];
        $messages = [
            'fullname.required' => 'Se requiere el nombre del académico.',
            'fullname.string' => 'Se requiere el nombre del académico.',
            'participation_type_id.required' => 'Se requiere el tipo de participación',
            'participation_type_id.integer' => 'Número de participación incorrecto.'
        ];

        $validatedData = $request->validate($rules, $messages);

        // Se busca si el usuario pertenece a la planta docente
        $academic=User::where('name',$request->input('fullname'))->first();

        $eventParticipant = new EventParticipant();
        $eventParticipant->event_id = $request->input('event_id');
        if($academic!=null) {
            $eventParticipant->user_id = $academic->id;
        }
        $eventParticipant->fullname=$request->input('fullname');
        $eventParticipant->participation_type_id=$request->input('participation_type_id');
        $eventParticipant->save();

        // $validatedData = $request->validate([
        //     'fullname' => 'required|string',
        //     'participation_type_id' => 'required|integer',
        //     'event_id' => 'required|integer',
        // ]);

        //EventParticipant::create($validatedData);

        return redirect()->route('events.participants',$event_id)->with('success', 'Participante registrado exitosamente.');
    }

    public function destroy(EventParticipant $participant)
    {   $event_id=$participant->event_id;
        $participant->delete();

        return redirect()->route('events.participants',$event_id)->with('success', 'Participante borrado exitosamente.');
    }
}
