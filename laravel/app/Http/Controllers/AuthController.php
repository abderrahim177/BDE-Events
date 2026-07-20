<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function showRegister(){
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

    public function Login() {}

    public function Logout() {}
}
