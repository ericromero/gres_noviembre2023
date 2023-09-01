<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventController;

// Ruta para mostrar la lista de eventos
Route::get('/events', [EventController::class, 'index'])->name('events.index');

// Ruta para mostrar el formulario de creación de evento
Route::get('/events/create', [EventController::class, 'create'])->name('events.create');

// Ruta para guardar el nuevo evento en la base de datos
Route::post('/events', [EventController::class, 'store'])->name('events.store');

// Ruta para mostrar los detalles de un evento específico
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');

// Ruta para mostrar el formulario de edición de un evento
Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');

// Ruta para actualizar los datos de un evento en la base de datos
Route::put('/events/{id}', [EventController::class, 'update'])->name('events.update');

// Ruta para eliminar un evento
Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');

// Ruta para acceder a los eventos de un usuario
Route::get('/my-events', [EventController::class, 'myEvents'])->name('events.my-events');

// Ruta para acceder a la creación de eventos
Route::get('/create', [EventController::class,'create'])->name('events.create');

// ruta para la revisión de eventos y aprobarlos o rechazarlos
Route::get('/review-events', [EventController::class, 'reviewEvents'])->name('events.review-events');

// ruta para actualizar el estatus de un evento
Route::put('/events/validacion/{event}', [EventController::class, 'validar'])->name('events.validar');

// Ruta para publicar un evento
Route::put('/events/{id}/publicar', [EventController::class, 'publish'])->name('events.publish');