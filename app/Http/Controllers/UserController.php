<?php

namespace App\Http\Controllers;

use App\Http\Repository\UserRepository;
use App\Http\Requests\LoginUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUsers() {}

    public function store() {}

    /**
     * Log in a user and return a Sanctum token.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginUserRequest $request)
    {
        //validate json data sent
        $credentials = $request->validated();

        //validate user data
        [$user, $token] = $this->userRepository->validateUser($credentials);

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
