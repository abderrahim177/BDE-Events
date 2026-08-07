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

        // 1. إنشاء المستخدم مع التشفير الآمن لكلمة السر
        $user = User::create([
            'name'     => $inputsValidated['name'],
            'email'    => $inputsValidated['email'],
            'password' => Hash::make($inputsValidated['password']),
            'role'     => 'student', 
        ]);

        // 2. إنشاء Token خاص بالجهة المستخدمة (React)
        $token = $user->createToken('auth_token')->plainTextToken;

        // 3. إرجاع الاستجابة مع البيانات والـ Token
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

        // 1. التحقق من الهوية (Email & Password)
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Les identifiants sont incorrects !'
            ], 401); // Unauthorized
        }

        $user = User::where('email', $credentials['email'])->firstOrFail();

        // 2. حذف الـ Tokens القديمة لمنع التعدد غير المرغوب فيه (اختياري وحسب الأمان المطلوبة)
        $user->tokens()->delete();

        // 3. إنشاء Token جديد
        $token = $user->createToken('auth_token')->plainTextToken;

        // 4. إرجاع الـ Token مع الدور (Role) لتسهيل الـ Routing فـ React
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