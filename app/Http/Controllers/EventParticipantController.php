<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventParticipant;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Adscription;
use App\Mail\WelcomeMailParticipant;
use Illuminate\Support\Facades\Mail;
use App\Models\ParticipationType;

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
                'required'
            ],
            'event_id' => [
                'required',
                'integer'],
            'degree_academic' => [
                'nullable',
                'required_if:fullname,other_academic',
            ],
            'other_academic_name' => [
                'nullable',
                'required_if:fullname,other_academic',
                'string',
                'max:250',
            ],
            'other_academic_email' => [
                'nullable',
                'required_if:fullname,other_academic',
                'email',
                'unique:users,email',
            ],
            'other_participation' => [
                'nullable',
                'required_if:participation_type_id,other',
                'string',
                'max:250',
            ],
            'external_academic' => 'nullable|boolean',
            
        ];
        $messages = [
            'fullname.required' => 'Se requiere el nombre del académico.',
            'fullname.string' => 'Se requiere el nombre del académico.',
            'participation_type_id.required' => 'Se requiere el tipo de participación',
            'participation_type_id.integer' => 'Número de participación incorrecto.',
            'degree_academic.required_if' => 'Se requiere el grado académico.',
            'other_academic_name.required_if' => 'Se requiere el nombre del nuevo académico(a).',
            'other_academic_name.max' => 'La longitud máxima para el nombre completo es de 250 caracteres incluyendo espacios.',
            'other_academic_email.required_if' => 'Se requiere el correo electrónico del nuevo académico(a).',
            'other_academic_email.email' => 'El formato del correo electrónico no es válido.',
            'other_academic_email.unique' => 'Este correo electrónico ya está registrado.',
            'other_participation.required_if' => 'Se requiere el nuevo tipo de participación.',
        ];
        
        $validatedData = $request->validate($rules, $messages);

        // Se busca si el usuario pertenece a la planta docente
        $academic=User::where('name',$request->input('fullname'))->first();
        $eventParticipant = new EventParticipant();

        // Verificar si es "Otro" en participation_type_id
        if ($request->input('participation_type_id') == 'other') {
            // Crear un nuevo tipo de participación en la tabla participation_types
            $newParticipationType = new ParticipationType();
            $newParticipationType->name = $request->input('other_participation');
            $newParticipationType->register_by = Auth::user()->id; // O el ID del usuario que está registrando
            $newParticipationType->save();

            // Actualizar participation_type_id con el ID del nuevo tipo de participación
            $request->merge(['participation_type_id' => $newParticipationType->id]);
        }

        // Crear el nuevo usuario si no existe
        if (!$academic) {
            $password=Str::random(8); // Generar una contraseña aleatoria
            $newAcademic = new User();
            $newAcademic->degree=$request->input('degree_academic');;
            $newAcademic->name = $request->input('other_academic_name');
            $newAcademic->email = $request->input('other_academic_email');
            $newAcademic->register_by=Auth::user()->id;
            $newAcademic->password = Hash::make($password); // O puedes usar el generador de contraseñas de Laravel
            $newAcademic->save();

            // Obtener el departamento del usuario logueado
            $loggedInUserDepartmentId = Auth::user()->team->department_id;

            // Crear una variable para almacenar el valor de external
            $external = $request->has('external_academic') ? 1 : 0;

            // Registrar la adscripción del nuevo usuario
            Adscription::create([
                'department_id' => $loggedInUserDepartmentId,
                'user_id' => $newAcademic->id,
                'external' => $external,
            ]);

            // Enviar el correo al nuevo usuario
            Mail::to($newAcademic->email)->send(new WelcomeMailParticipant($newAcademic->email, $password));

            // Asignar el ID del nuevo usuario
            $eventParticipant->user_id = $newAcademic->id;
            $eventParticipant->fullname= $newAcademic->name;
        }

        $eventParticipant->event_id = $request->input('event_id');
        if($academic!=null) {
            $eventParticipant->user_id = $academic->id;
            $eventParticipant->fullname = $academic->name;
        }

        $eventParticipant->participation_type_id=$request->input('participation_type_id');
        $eventParticipant->save();

        return redirect()->route('events.participants',$event_id)->with('success', 'Participante registrado exitosamente.');
    }

    public function edit(Event $event) {
        // Obtener los tipos de participantes
        $participationTypes = ParticipationType::all();
        $participants=EventParticipant::where('event_id',$event->id)->get();
        $academics = User::has('adscriptions.department')->get();
        return view('eventparticipants.edit', compact('event', 'participationTypes','participants','academics'));
    }

    public function destroy(EventParticipant $participant)
    {   $event_id=$participant->event_id;
        $participant->delete();

        return redirect()->route('events.participants',$event_id)->with('success', 'Participante borrado exitosamente.');
    }
}
