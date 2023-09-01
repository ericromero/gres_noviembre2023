<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CanceledEvent;
use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Space;

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

    public function create()
    {
        // Obtener la lista de espacios disponibles para el evento
        $spaces = Space::all();

        // Aquí puedes agregar otras variables o lógica que necesites para la vista de creación de eventos

        return view('events.create', compact('spaces'));
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

        $user = Auth::user();

        $event = new Event();
        $event->user_id = $user->id;
        $event->title = $request->input('title');
        $event->summary = $request->input('summary');
        $event->start_date = $request->input('start_date');
        $event->end_date = $request->input('end_date');
        $event->start_time = $request->input('start_time');
        $event->end_time = $request->input('end_time');
        $event->space_id = $request->input('space_id');
        $event->registration_required  = $request->has('requires_registration');
        $event->registration_url = $request->input('registration_url');

        // Guardar la imagen de portada
        if ($request->hasFile('cover_image')) {
            $coverImage = $request->file('cover_image');
            $imageName = time() . '_' . $coverImage->getClientOriginalName();
            $coverImage->move(public_path('images/events'), $imageName);
            $event->cover_image = 'images/events/' . $imageName;
        }

        $event->save();

        return redirect()->route('events.my-events')->with('success', 'El evento ha sido creado exitosamente.');
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
}
