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

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'Register'])->name('register.submit');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'Login'])->name('login.submit');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware(['auth', RoleMiddleware::class . ':student'])->group(function () {
    Route::get('/students', [GetAllevenmentController::class, 'index'])->name('students.dashboard');
    Route::get('/ticket', [TecketController::class, 'store'])->name('Ticket');
    Route::get('/reservation/{id}', [ReserverEventController::class, 'store'])->name('reservation');
});

Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin', [GetAllevenmentController::class, 'DetailEvent'])->name('admin.dashboard');
    Route::post('/admin/create', [CreateEvenmentController::class, 'Create'])->name('Create_evenment');
    Route::get('/reservations', [CreateEvenmentController::class, 'index'])->name('admin.reservations.index');
    Route::patch('/reservations/{id}/status', [CreateEvenmentController::class, 'updateStatus'])->name('admin.reservations.updateStatus');
});