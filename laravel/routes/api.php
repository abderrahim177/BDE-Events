<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CreateEvenmentController;
use App\Http\Controllers\GetAllevenmentController;
use App\Http\Controllers\ReserverEventController;
use App\Http\Controllers\TecketController;
use App\Http\Middleware\RoleMiddleware;

Route::post('/register', [AuthController::class, 'Register'])->middleware('throttle:5,1'); // 5 محاولات فالدقيقة
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:login');

Route::middleware(['auth:sanctum', 'throttle:60,1'])->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::middleware(RoleMiddleware::class . ':student')->group(function () {
        Route::get('/students', [GetAllevenmentController::class, 'index']);
        Route::get('/ticket', [TecketController::class, 'store']);
        Route::post('/reservation/{id}', [ReserverEventController::class, 'store']);
        Route::get('/totaleTiket', [TecketController::class, 'CountTiket']);
    });

    Route::middleware(RoleMiddleware::class . ':admin')->group(function () {
        Route::get('/admin', [GetAllevenmentController::class, 'DetailEvent']);
        Route::post('/admin/create', [CreateEvenmentController::class, 'Create']);
        Route::get('/eventManage', [CreateEvenmentController::class, 'index']);
        Route::get('/stats', [GetAllevenmentController::class, 'TotaleEvenment']);
        Route::delete('/eventManage/{id}', [CreateEvenmentController::class, 'destroy']);
    });

});