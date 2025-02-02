<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function getUsers() {}

    public function store() {
        
    }

    /**
     * Log in a user and return a Sanctum token.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginUserRequest $request)
    {

        $credentials = $request->validated();

        $loginType = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? "email" : "username";

        if (!Auth::attempt([$loginType => $credentials['login'], 'password' => $credentials['password']])) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();

        // Delete all pre-existing tokens
        $user->tokens()->delete();

        // Create a new token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
        ]);
    }

    /**
     * Log out a user and revoke the Sanctum token.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout successful',
        ]);
    }
}
