<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventParticipantController;

Route::middleware(['role:Coordinador|Gestor de eventos'])->group(function () {
    // Ruta para agregar un participante al evento
    Route::post('/eventos/guarda/participante', [EventParticipantController::class, 'storeParticipant'])->name('eventparticipant.storeparticipant');

    // Ruta para agregar un participante al evento
    Route::get('/eventos/edita/participantes/{event}', [EventParticipantController::class, 'edit'])->name('eventparticipants.edit');

    // Ruta para agregar un participante al evento
    Route::post('/eventos/actualiza/participante', [EventParticipantController::class, 'updateParticipant'])->name('eventparticipant.updateparticipant');

    // Ruta para borrar un participante
    Route::get('/participante/quitar/{participant}', [EventParticipantController::class,'destroy'])->name('eventparticipant.delete');

    // Ruta para borrar un participante
    Route::get('/participante/remover/{participant}', [EventParticipantController::class,'destroy_update'])->name('eventparticipant.delete.update');

});