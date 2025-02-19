<?php

namespace App\Http\Controllers;

use App\Http\Repository\UserRepository;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Resources\UserLoginResource;
use App\Http\Resources\UserResource;
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

    /**
     * Summary of store
     * Create new user.
     * @param \App\Http\Requests\CreateUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateUserRequest $request) {
        $credentials = $request->validated();
        $user = $this->userRepository->createUser($credentials);

        return (new UserResource((object) ['message' => 'User created successfully', 'user' => $user]))->response()->setStatusCode(201);
    }


    /**
     * Summary of login
     * Log in a user and return a Sanctum token.
     * @param \App\Http\Requests\LoginUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginUserRequest $request)
    {
        //validate json data sent
        $credentials = $request->validated();

        //attempt login in user
        $validationResult = $this->userRepository->validateUser($credentials);

        if($validationResult === null){
            return response()->json(['message' => 'Invalid credentials'], 401);
        }else{
            [$user, $token] = $validationResult;
        }

        return (new UserLoginResource((object) ['user' => $user, 'token' => $token]))
            ->response()
            ->setStatusCode(200);
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
        ], 200);
    }
}
