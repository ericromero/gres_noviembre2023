<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CanceledEvent;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventParticipant;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Space;
use App\Models\EventType;
use App\Models\ParticipationType;
use App\Models\User;
use App\Models\EventSpace;
use App\Models\EventStreaming;
use App\Models\EventRecording;
use Illuminate\Support\Facades\Mail;
use App\Mail\RequestSpaceEmail;
use App\Mail\RequestRecordEmail;
use App\Mail\RequestStreamingEmail;


class EventController extends Controller
{
    public function cartelera() {
        $now = Carbon::now();

        $events = Event::where('published', true)
            ->where('end_date', '>', $now)
            ->get();

        return view('welcome',compact('events'));
    }

    public function myEvents()
    {
        $userEvents = Auth::user()->events; // Recupera los eventos del usuario autenticado
        return view('events.my-events', compact('userEvents'));
    }

    public function availableSearch() {
        return view('events.availablesearch');
    }

    public function availableResult() {

    }

    public function create()
    {
        // Obtener los listados de usuarios para seleccionar responsable y corresponsable, éste último puede ser de cualquier departamento
        // $authUser = Auth::user();
        // $userDepartments = $authUser->adscriptions()->pluck('department_id');

        // $responsables = User::whereIn('id', function ($query) use ($userDepartments) {
        //     $query->select('user_id')
        //         ->from('adscriptions')
        //         ->whereIn('department_id', $userDepartments);
        // })->get();

        // Obtener los usuarios con departamento asignado
        $academicos = User::has('adscriptions.department')->get();
        
        // Obtener la lista de tipos de eventos disponibles
         $eventTypes = EventType::all();

        return view('events.create', compact('eventTypes','academicos'));
    }

    public function createWithSpace(Request $request)
    {
        // Obtén el usuario autenticado
        $user = Auth::user();

        // Lista de departamentos a los que pertenece el usuario
        $departments = $user->adscriptions->map(function ($adscription) {
            return $adscription->department;
        });

        $space=Space::find($request->space);
        $start_date=$request->start_date;
        $end_date=$request->end_date;
        $start_time=$request->start_time;
        $end_time=$request->end_time;

        // Obtener los usuarios con departamento asignado
        $academicos = User::has('adscriptions.department')->get();

        // Obtener la lista de tipos de eventos disponibles
         $eventTypes = EventType::all();

        return view('events.create', compact('space','eventTypes','start_date','end_date','start_time','end_time','academicos','departments'));
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'title' => 'required|string|max:255',
        //     'summary' => 'required|string',
        //     'start_date' => 'required|date|after_or_equal:' . now()->addDays(4)->format('Y-m-d'),
        //     'end_date' => 'required|date|after_or_equal:start_date',
        //     'start_time' => 'required|date_format:H:i|after_or_equal:07:00|before:end_time',
        //     'end_time' => 'required|date_format:H:i|after:start_time|before_or_equal:21:00',
        //     'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'space_id' => 'required|exists:spaces,id',
        //     'requires_registration' => 'boolean',
        //     'registration_url' => 'nullable|required_if:requires_registration,true',
        // ]);

        $user=Auth::user();

        $event = new Event();
        $event->responsible_id = $request->input('responsable');
        $event->coresponsible_id = $request->input('corresponsable');
        $event->register_id = $user->id;
        $event->department_id = $request->input('department');
        $event->title = $request->input('title');
        $event->summary = $request->input('summary');
        $event->start_date = $request->input('start_date');
        $event->end_date = $request->input('end_date');
        $event->start_time = $request->input('start_time');
        $event->end_time = $request->input('end_time');
        // $event->space_id = $request->input('space_id');
        $event->registration_required  = $request->has('requires_registration');
        $event->registration_url = $request->input('registration_url');

        // Guardar la imagen de portada
        if ($request->hasFile('cover_image')) {
            $coverImage = $request->file('cover_image');
            $imageName = time() . '_' . $coverImage->getClientOriginalName();
            $coverImage->move(public_path('images/events'), $imageName);
            $event->cover_image = 'images/events/' . $imageName;
        }
        
        // Guardar el tipo de evento
        $event->event_type_id = $request->input('event_type_id');

        // Guardar el programa si está presente
        if ($request->hasFile('program')) {
            $programFile = $request->file('program');
            $programName = time() . '_' . $programFile->getClientOriginalName();
            $programFile->move(public_path('program_files'), $programName);
            $event->program = 'program_files/' . $programName;
        }

        $event->transmission_required = $request->has('transmission_required');
        $event->recording_required = $request->has('recording_required');

        if($request->input('space')!=null) {
            $event->space_required=true;
        }

        $event->save();

        // Se debe almacenar la información para validar transmision, grabacion y espacio
        // Gestión de espacio
        if($request->input('space')!=null) {
            $eventSpace = new EventSpace();
            $eventSpace->event_id=$event->id;
            $eventSpace->space_id=$request->input('space');
            $eventSpace->save();
        }

        // Gestión de tranmisión
        if(isset($event->transmission_required)&&$event->transmission_required==true) {
            $eventBroadcast = new EventStreaming();
            $eventBroadcast->event_id=$event->id;
            $eventBroadcast->save();
        }

        // Gestión de espacio
        if(isset($event->recording_required)&&$event->recording_required==true) {
            $eventRecording = new EventRecording();
            $eventRecording->event_id=$event->id;
            $eventRecording->save();
        }

        return redirect()->route('events.participants',$event->id);
        //return redirect()->route('events.my-events')->with('success', 'El evento ha sido creado exitosamente.');
    }

    public function reviewEvents()
    {
        // Obtener todos los eventos pendientes de revisión
        $events = Event::where('status', 'solicitado')->get();
        return view('events.review-events', compact('events'));
    }

    public function validar(Request $request, Event $event)
    {
       
        $request->validate([
            'status' => 'required|in:aceptado,rechazado',
        ]);

        // Obtener el usuario autenticado
        $user = Auth::user();

        $event->status=$request->status;
        $event->validate_by=$user->id;

        if ($request->input('status') === 'rechazado') {
            $request->validate([
                'cancellation_reason' => 'required',
            ]);

            // Actualiza la razón de cancelación
            $canceled_event=new CanceledEvent();
            $canceled_event->event_id=$event->id;
            $canceled_event->canceled_by_user_id=$user->id;
            $canceled_event->cancellation_reason=$request->cancellation_reason;
            $canceled_event->save();
        }

        $event->save();

        return redirect()->route('events.review-events')
            ->with('success', 'Evento '.$request->input('status').'.');
    }

    public function publish($id)
    {
        $event = Event::findOrFail($id);
        $event->update(['published' => true]);

        return redirect()->route('events.my-events')->with('success', 'El evento ha sido publicado exitosamente.');
    }

    public function registrarParticipantes(Event $event) {
        // Obtener los tipos de participantes (ajusta esto según cómo los obtienes)
        $participationTypes = ParticipationType::all();
        $participants=EventParticipant::where('event_id',$event->id)->get();
        return view('events.eventparticipants', compact('event', 'participationTypes','participants'));
    }

    public function menuEdt(Event $event) {
        return view('event.menuedit',compact('event'));
    }

    public function destroy(Event $event)
    {
        // Eliminar los registros relacionados en event_participants
        $event->participants()->delete();

        // Eliminar la imagen de portada si existe
        if ($event->cover_image) {
            $imagePath = public_path($event->cover_image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        if ($event->program) {
            $programPath = public_path($event->program);
            if (file_exists($programPath)) {
                unlink($programPath);
            }
        }

        $event->delete();

        return view('dashboard')->with('success', 'El registro del evento ha sido cancelado.');
    }

    public function searchparticipant(Request $request) {
        $academico = User::where('doi', $request->user_doi)->first();
        $event = Event::find($request->event_id);
        $participants=EventParticipant::where('event_id',$request->event_id)->get();
        $participationTypes = ParticipationType::all();
    
        if ($academico != null) {
            $message = 'Registro encontrado';
            return view('events.eventparticipants', compact('event', 'academico', 'participationTypes', 'message','participants'));
        } else {
            $message = 'No se encontró el registro';
            return view('events.eventparticipants', compact('event', 'participationTypes', 'message'));
        }
    }

    public function register(Event $event) {
        // Se actualiza el estado del registro
        $event->status='solicitado';
        if($event->space_required=='0') {
            $event->published=1;
            $event->status='finalizado';
        }
        $event->save();

        // Notificación al gestor de espacio
        $eventSpace=EventSpace::where('event_id',$event->id)->first();
        $space=Space::find($eventSpace->space_id);
        if($event->space_required==1) { // Se verifica si el evento solicito espacio, se registra y notifica al usuario correspondiente
            $user=User::find($space->department->responsible_id);
            Mail::to($user->email)->send(new RequestSpaceEmail($event, $space));
        }

        // Notificación al gestor de grabación
        if($event->recording_required!=null&&$event->recording_required==1) {
            Mail::to('udemat.psicologia@unam.mx')->send(new RequestRecordEmail($event, $space));
        }

        // Notificación al gestor de transmisión 
        if($event->transmission_required!=null&&$event->transmission_required==1) {
            Mail::to('udemat.psicologia@unam.mx')->send(new RequestStreamingEmail($event, $space));
        }

        return redirect()->route('dashboard')->with('success', 'Evento registrado correctamente. En el apartado "Eventos de la coordinación" puede publicar el evento.');
    }

    public function by_area()
    {        
        $events=$this->eventsByDepartment();
        return view('events.by-area', compact('events'));
    }

    public function eventsByDepartment() {
        // Obtén el usuario autenticado
        $user = Auth::user();

        // Obtén los IDs de los departamentos a los que el usuario está adscrito
        $departmentIds = $user->adscriptions->pluck('department_id');

        // Obtén los eventos que pertenecen a los departamentos del usuario
        $events = Event::whereIn('department_id', $departmentIds)->get();
        return $events;

    }

    public function calendario() {
        $allEvents=Event::where('published','1')->get();
        $events=[];
        foreach($allEvents as $event) {
            $events[] = [
                'title'=>$event->title,
                'start' => $event->start_date . ' ' . $event->start_time, // Combina fecha y hora de inicio
                'end' => $event->end_date . ' ' . $event->end_time,       // Combina fecha y hora de finalización
                'id'=>$event->id,
            ];
        }
        return view ('calendar',compact('events'));
    }

    public function show(Event $event) {
        return view('events.show',compact('event'));
    }
}
