<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventController;

Route::middleware(['role:Coordinador|Gestor de eventos'])->group(function () {
    // Ruta para encontrar disponibilidad de horario para reservar
    Route::get('/eventos/disponibilidad', [EventController::class, 'availableSearch'])->name('events.availableSearch');

    // Ruta para acceder a la creación de eventos
    //Route::post('/evento/seleccionado', [EventController::class,'createWithSpace'])->name('events.createwithSpace');
    Route::get('/events/seleccionado', [EventController::class,'createWithSpace'])->name('events.createwithSpace');


    // Ruta para guardar el nuevo evento en la base de datos
    Route::post('/eventos/guardar', [EventController::class, 'store'])->name('events.store');

    //Ruta para acceder a la creación de eventos
    Route::get('/evento/nuevo', [EventController::class,'create'])->name('events.create');

    //Ruta para acceder a la creación de eventos
    //Route::post('/evento/nuevo', [EventController::class,'create'])->name('events.create');

    // Ruta para guadar los participantes de un evento
    Route::get('/events/{event}/participantes', [EventController::class, 'registrarParticipantes'])->name('events.participants');

    // Ruta para guardar el nuevo evento en la base de datos
    //Route::post('/eventos/busca/participante', [EventController::class, 'searchparticipant'])->name('event.searchparticipant');

    // Ruta para eliminar un evento
    Route::delete('/eventos/{id}', [EventController::class, 'destroy'])->name('events.destroy');

    //Ruta para acceder a la creación de eventos
    Route::get('/evento/registro/{event}', [EventController::class,'register'])->name('events.register');

    //Ruta para acceder a la creación de eventos
    Route::get('/eventos/area', [EventController::class,'by_area'])->name('events.byArea');
    
});

// Ruta para acceder a los eventos de un usuario
Route::get('/mis_eventos', [EventController::class, 'myEvents'])->name('events.my-events');

// Ruta para mostrar los detalles de un evento específico
Route::get('/evento/detalle/{event}', [EventController::class, 'show'])->name('events.show');

// Ruta para mostrar la lista de eventos
//Route::get('/eventos', [EventController::class, 'index'])->name('events.index');

// // Ruta para acceder a la creación de eventos
// Route::get('/evento/nuevo', [EventController::class,'create'])->name('events.create');



// // Ruta para guadar los participantes de un evento
// Route::get('/evento/{event}/menu_edicion', [EventController::class, 'menuEdit'])->name('events.menuEdit');

// // Ruta para mostrar el formulario de edición de un evento
// Route::get('/eventos/{id}/modificar', [EventController::class, 'edit'])->name('events.edit');

// // Ruta para actualizar los datos de un evento en la base de datos
// Route::put('/eventos/{id}', [EventController::class, 'update'])->name('events.update');

// // ruta para la revisión de eventos y aprobarlos o rechazarlos
// Route::get('/review-events', [EventController::class, 'reviewEvents'])->name('events.review-events');

// // ruta para actualizar el estatus de un evento
// Route::put('/events/validacion/{event}', [EventController::class, 'validar'])->name('events.validar');

// // Ruta para publicar un evento
// Route::put('/events/{id}/publicar', [EventController::class, 'publish'])->name('events.publish');


