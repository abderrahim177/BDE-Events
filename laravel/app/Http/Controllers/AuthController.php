<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Inscription (Register)
     */
    public function register(AuthRequest $request)
    {
        $inputsValidated = $request->validated();

        $user = User::create([
            'name'     => $inputsValidated['name'],
            'email'    => $inputsValidated['email'],
            'password' => Hash::make($inputsValidated['password']),
            'role'     => 'student', 
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status'  => 'success',
            'message' => 'Compte créé avec succès !',
            'user'    => [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
                'role'  => $user->role,
            ],
            'token'   => $token
        ], 201);
    }

    /**
     * Connexion (Login)
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Les identifiants sont incorrects !'
            ], 401); 
        }
        $user = User::where('email', $credentials['email'])->firstOrFail();
        $user->tokens()->delete();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'status'  => 'success',
            'message' => 'Connexion réussie !',
            'user'    => [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
                'role'  => $user->role,
            ],
            'token'   => $token
        ], 200);
    }

    /**
     * Déconnexion (Logout)
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Déconnexion réussie !'
        ], 200);
    }
}