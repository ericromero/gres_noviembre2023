<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    // Ruta para mostrar la lista de permisos
    Route::get('/permissions', 'PermissionController@index')->name('permissions.index');

    // Ruta para mostrar el formulario de creación de permiso
    Route::get('/permissions/create', 'PermissionController@create')->name('permissions.create');

    // Ruta para guardar un nuevo permiso en la base de datos
    Route::post('/permissions', 'PermissionController@store')->name('permissions.store');

    // Ruta para mostrar el formulario de edición de un permiso
    Route::get('/permissions/{permission}/edit', 'PermissionController@edit')->name('permissions.edit');

    // Ruta para actualizar un permiso en la base de datos
    Route::put('/permissions/{permission}', 'PermissionController@update')->name('permissions.update');

    // Ruta para eliminar un permiso de la base de datos
    Route::delete('/permissions/{permission}', 'PermissionController@destroy')->name('permissions.destroy');
});
