<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CreateEvenmentController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

// 🌐 Routes عمومية (Public)
Route::get('/', function () {
    return view('welcome');
});

// 🔐 Routes ديال الـ Guest (قبل ما يدير تسجيل الدخول)
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'Register'])->name('register.submit');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'Login'])->name('login.submit');
});

// 🎓 Routes الخاصة بالطالب فقط (Student)
Route::middleware(['auth', RoleMiddleware::class . ':student'])->group(function () {
    Route::get('/students', function () {
        return view('clients.dashboard');
    })->name('students.dashboard');

    Route::get('/ticket', function () {
        return view('clients.ticket');
    })->name('ticket');
});

// 🛡️ Routes الخاصة بـ الأدمن فقط (Admin)
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

// 🚪 Logout Route
Route::middleware('auth')->group(function (){
Route::post('/admin/create' , [CreateEvenmentController::class , 'Create'])->name('Create_evenment');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
