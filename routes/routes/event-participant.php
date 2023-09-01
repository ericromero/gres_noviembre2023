<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventParticipantController;

Route::middleware(['role:Coordinador|Gestor de eventos'])->group(function () {
    // Ruta para agregar un participante al evento
    Route::post('/eventos/guarda/participante', [EventParticipantController::class, 'storeParticipant'])->name('eventparticipant.storeparticipant');

    // Ruta para borrar un participante
    Route::get('/participante/quitar/{participant}', [EventParticipantController::class,'destroy'])->name('eventparticipant.delete');
});