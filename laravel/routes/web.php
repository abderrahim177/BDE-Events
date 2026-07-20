<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/connexion', function (){
    return view('auth.connexion');
});

Route::get('/admin', function (){
    return view('admin.dashboard');
});

Route::get('/students', function (){
    return view('clients.dashboard');
});

