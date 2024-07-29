<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate input
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Attempt authentication
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $user = Auth::user();
            // Log successful login
            Log::info('User logged in successfully', ['username' => $request->username]);

            return response()->json([
                'status' => 'success',
                'message' => 'Login successful',
            ], 200);
        }

        // Log failed login attempt
        Log::warning('Failed login attempt', ['username' => $request->username]);

        // Authentication failed
        return response()->json([
            'status' => 'error',
            'message' => 'The provided credentials do not match our records.'
        ], 401);
    }
}
