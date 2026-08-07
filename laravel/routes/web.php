<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CreateEvenmentController;
use App\Http\Controllers\GetAllevenmentController;
use App\Http\Controllers\ReserverEventController;
use App\Http\Controllers\TecketController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
