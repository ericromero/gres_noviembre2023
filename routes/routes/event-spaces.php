<?php

use App\Http\Controllers\EventSpaceController;
use Illuminate\Support\Facades\Route;

Route::middleware(['role:Gestor de espacios'])->group(function () {
    // Ruta para agregar un participante al evento
    Route::get('/solicitud_de_espacios', [EventSpaceController::class, 'index'])->name('event_spaces.review');

    Route::post('/events/autorizar/{event}', [EventSpaceController::class, 'authorizeRequestSpace'])->name('events.authorize');
    Route::post('/events/rechazar/{event}', [EventSpaceController::class, 'rejectRequestSpace'])->name('events.reject');
    
});