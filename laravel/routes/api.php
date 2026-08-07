<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CreateEvenmentController;
use App\Http\Controllers\GetAllevenmentController;
use App\Http\Controllers\ReserverEventController;
use App\Http\Controllers\TecketController;
use App\Http\Middleware\RoleMiddleware;

Route::post('/register', [AuthController::class, 'Register']);
Route::post('/login', [AuthController::class, 'Login']);

Route::get('/events/public', [GetAllevenmentController::class, 'getEventsNotReserved']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::middleware(RoleMiddleware::class . ':student')->group(function () {
        Route::get('/students', [GetAllevenmentController::class, 'index']);
        Route::get('/ticket', [TecketController::class, 'store']);
        Route::post('/reservation/{id}', [ReserverEventController::class, 'store']); 
    });
    Route::middleware(RoleMiddleware::class . ':admin')->group(function () {
        Route::get('/admin', [GetAllevenmentController::class, 'DetailEvent']);
        Route::post('/admin/create', [CreateEvenmentController::class, 'Create']);
        Route::get('/reservations', [CreateEvenmentController::class, 'index']);
        // Route::patch('/reservations/{id}/status', [CreateEvenmentController::class, 'updateStatus']);
    });
});