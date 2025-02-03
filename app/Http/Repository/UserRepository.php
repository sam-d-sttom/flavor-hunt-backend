<?php

namespace App\Http\Repository;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository 
{

    /**
     * Summary of createUser
     * creates a user and returns the user details
     * @param array $credentials
     * @return user
     */
    public function createUser(Array $credentials){
        $user = User::create($credentials);
        return $user;
    }

    /**
     * Summary of validateUser
     * validate user, returns user and token.
     * @param array $credentials
     * @return array<string|\Illuminate\Contracts\Auth\Authenticatable|null>|mixed|\Illuminate\Http\JsonResponse
     */
    public function validateUser(Array $credentials){

        //Check if user uses email or username to login.
        $loginType = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? "email" : "username";

        if (!Auth::attempt([$loginType => $credentials['login'], 'password' => $credentials['password']])) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();

        // Delete all pre-existing tokens
        $user->tokens()->delete();

        // Create a new token
        $token = $user->createToken('auth_token')->plainTextToken;

        return [$user, $token];

    }
}