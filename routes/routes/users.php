<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::group(['middleware' => ['permission:gestionar usuarios']], function () {
    // Rutas protegidas por el middleware de permisos

    // Ruta para mostrar la lista de usuarios
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    // Ruta para mostrar el formulario de creación de usuario
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');

    // Ruta para guardar el nuevo usuario en la base de datos
    Route::post('/users', [UserController::class, 'store'])->name('users.store');

    // Ruta para mostrar los detalles de un usuario específico
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');

    // Ruta para mostrar el formulario de edición de un usuario
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');

    // Ruta para actualizar los datos de un usuario en la base de datos
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

    // Ruta para eliminar un usuario
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});
