<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventType;

class EventTypeController extends Controller
{
    public function index()
    {
        $eventTypes = EventType::all();
        return view('event_types.index', compact('eventTypes'));
    }

    public function create()
    {
        return view('event_types.create');
    }

    public function store(Request $request)
    {
        // Validar y almacenar el nuevo tipo de evento
        // ...
    }

    // Define otras acciones según tus necesidades (editar, actualizar, eliminar, etc.)
}
