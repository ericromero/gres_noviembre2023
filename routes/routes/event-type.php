<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventTypeController;

Route::middleware(['role:Administrador'])->group(function () {

    Route::resource('event-types', EventTypeController::class);
});
