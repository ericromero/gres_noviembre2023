<?php

use Illuminate\Support\Facades\Route;

Route::resource('roles', RoleController::class)->middleware(['auth', 'verified']);