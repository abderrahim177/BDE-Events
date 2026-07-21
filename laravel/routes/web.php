<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/admin', function (){
    return view('admin.dashboard');
})->name('/admin');

Route::get('/ticket' , function (){
    return view('clients.ticket');
})->name('ticket');

Route::get('/students', function (){
    return view('clients.dashboard');
})->name('/students');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register' , [AuthController::class , 'register'])->name('register');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login' , [AuthController::class , 'Login'])->name('Login');