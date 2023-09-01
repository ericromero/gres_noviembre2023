<?php

use Illuminate\Support\Facades\Route;

Route::resource('permissions', PermissionController::class)->middleware(['auth', 'verified']);