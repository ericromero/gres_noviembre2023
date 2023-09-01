<?php

use Illuminate\Support\Facades\Route;
// routes/routes/spaces.php

use App\Http\Controllers\SpaceController;

// Ruta para mostrar la lista de espacios
Route::get('/spaces', [SpaceController::class, 'index'])->name('spaces.index');

// Ruta para mostrar el formulario de creación de espacio
Route::get('/spaces/create', [SpaceController::class, 'create'])->name('spaces.create');

// Ruta para guardar el nuevo espacio en la base de datos
Route::post('/spaces', [SpaceController::class, 'store'])->name('spaces.store');

// Ruta para mostrar los detalles de un espacio específico
Route::get('/spaces/{id}', [SpaceController::class, 'show'])->name('spaces.show');

// Ruta para mostrar el formulario de edición de un espacio
Route::get('/spaces/{id}/edit', [SpaceController::class, 'edit'])->name('spaces.edit');

// Ruta para actualizar los datos de un espacio en la base de datos
Route::put('/spaces/{id}', [SpaceController::class, 'update'])->name('spaces.update');

// Ruta para eliminar un espacio
Route::delete('/spaces/{id}', [SpaceController::class, 'destroy'])->name('spaces.destroy');
