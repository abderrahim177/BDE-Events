<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CreateEvenmentController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GetAllevenmentController;
use App\Http\Controllers\ReserverEventController;
use App\Http\Controllers\TecketController;

// 🌐 Routes عمومية (Public)
Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'Register'])->name('register.submit');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'Login'])->name('login.submit');
});
// hada diyal students 
Route::middleware(['auth', RoleMiddleware::class . ':student'])->group(function () {
    Route::get('/students', function () {
        return view('clients.dashboard');
    })->name('students.dashboard');

    Route::get('/ticket', function () {
        return view('clients.ticket');
    })->name('ticket');
});
// hada diyal admin
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

Route::middleware('auth')->group(function (){
Route::post('/admin/create' , [CreateEvenmentController::class , 'Create'])->name('Create_evenment');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/students', [GetAllevenmentController::class, 'index'])->name('students.dashboard');
Route::get('/reservation/{id}', [ReserverEventController::class, 'store'])->name('reservation');
Route::get('/ticket' , [TecketController::class , 'store'])->name('Ticket');
Route::get('/ticket/download/{id}', [TecketController::class, 'download'])->name('ticket.download');
});
