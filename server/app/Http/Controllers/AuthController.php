<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|string|email|max:255|unique:users,user_email',
            'password' => 'required|string|min:8|confirmed'
            // password_confirmation 
        ]);

        try {
            $user = User::create([
                'user_name' => $request->user_name,
                'user_email' => $request->user_email,
                'password' => Hash::make($request->password)
            ]);

            Auth::login($user);

            $request->session()->regenerate();

            return response()->json([
                'status' => 'success',
                'message' => 'User registered successfully.',
                'data' => [
                    'user' => $user,
                ]
            ], 201);
        } catch (\Exception $error) {
            Log::error("Register Error", [
                'exception' => $error
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Register failed. Please try again later.'
            ], 500);
        }
    }


    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'user_email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        try {
            if (!Auth::attempt([
                'user_email' => $request->user_email,
                'password' => $request->password
            ])) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid credentials'
                ], 401);
            }

            $request->session()->regenerate();

            return response()->json([
                'status' => 'success',
                'message' => 'Login successfully.'
            ], 200);
        } catch (\Exception $error) {
            Log::error("Login Error", [
                'exception' => $error
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred during login. Please try again later.'
            ], 500);
        }
    }


    public function logout(Request $request): JsonResponse
    {
        try {
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return response()->json([
                'status' => 'success',
                'message' => 'Logout successfully.'
            ], 200);
        } catch (\Exception $error) {
            Log::error("Logout Error", [
                'exception' => $error
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Could not logout. Please try again later.'
            ], 500);
        }
    }
}
