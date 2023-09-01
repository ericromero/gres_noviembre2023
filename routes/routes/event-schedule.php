<?php

use App\Http\Controllers\EventScheduleController;
use Illuminate\Support\Facades\Route;

// Ruta para mostrar el formulario de solicitud de espacio para un evento
Route::get('/event-schedule/create', [EventScheduleController::class, 'create'])->name('event-schedule.create');

// Ruta para guardar la solicitud de espacio para un evento
Route::post('/event-schedule', [EventScheduleController::class, 'store'])->name('event-schedule.store');

// Ruta para mostrar el formulario de edición de la solicitud de espacio
Route::get('/event-schedule/{id}/edit', [EventScheduleController::class, 'edit'])->name('event-schedule.edit');

// Ruta para actualizar la solicitud de espacio
Route::put('/event-schedule/{id}', [EventScheduleController::class, 'update'])->name('event-schedule.update');

// Ruta para eliminar la solicitud de espacio
Route::delete('/event-schedule/{id}', [EventScheduleController::class, 'destroy'])->name('event-schedule.destroy');
