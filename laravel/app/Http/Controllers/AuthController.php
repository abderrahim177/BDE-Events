<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\loginRequest;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{

    public function showRegister(){
        return view('auth.connexion');
    }

    public function showLogin(){
        return view('auth.connexion');
    }

    public function Register(AuthRequest $request)
    {
         $request->validated();
        $user =User::create([
            'name' => $request->name, 
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'student',
        ]);
        Auth::login($user);
        return redirect()->route('/students')->with('success', 'Bienvenue sur BDE-Events !');
    }

     public function Login(loginRequest $request)
{
    $credentials = $request->validated();
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('students.dashboard'); 
    }
    return back()->withErrors([
        'email' => 'Vos identifiants sont incorrects !',
    ]);
}

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }
}
