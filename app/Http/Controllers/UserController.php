<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Auth;

class UserController extends Controller
{
    //

    /**
     * Summary of createUser
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function createUser(Request $request)
    {
        $postData = $request->json()->all();


        //checking if these datas were passed in the request bodies
        if (!array_key_exists("userName", $postData) || !array_key_exists("firstName", $postData) || !array_key_exists("lastName", $postData) || !array_key_exists("email", $postData) || !array_key_exists("password", $postData)) {
            return response()->json([
                'status_code' => '422',
                'message' => 'Error, incomplete request data',
            ], 422);
        }

        //Define validation rules of the data
        $rules = [
            'userName' => 'required|string|max:255|unique:users,user_name',
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ];

        $validator = Validator::make($postData, $rules);

        if($validator->fails()){

            $errors = $validator->errors()->messages();

            $errors_messages = array_map(function($message){
                return $message[0];
            }, array_values($errors));

            return response()->json([
                'status_code' => '422',
                'message' => 'Error, incomplete or inconsistent request data',
                'error' => $errors_messages
            ], 422);
        }

        //create user
        $user = User::create([
            'user_name' => $postData['userName'],
            'first_name' => $postData['firstName'],
            'last_name' => $postData['lastName'],
            'email' => $postData['email'],
            'password' => $postData['password'],
        ]);

        return response()->json([
            'status_code' => '201',
            'message' => 'User created successfully',
            'data' => $user
        ], 201);
    }


    public function validateUser(Request $request){
        // dd($request);

        $data = $request->json()->all();

        // if(!array_key_exists("username", $data) || !array_key_exists("password", $data)){
        //     return response()->json([
        //         'status_code' => '422',
        //         'message' => 'Error, incomplete request data',
        //     ], 422);
        // }

        //Define validation rules of the data
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];

        $validator = Validator::make($data, $rules);

        if($validator->fails()){
            $errors = $validator->errors()->messages();

            return response()->json([
                'status_code' => '422',
                'message' => 'Error, incomplete request data',
                'error' => $errors
            ], 422);
        }

        // $match = User::where('user_name', $data['username'])->orWhere('email', $data['username'])->where('password', 'password')->first();

        $match = Auth::attempt([
            "user_name" => $data["username"],
            "password" => $data["password"]
        ]);


        if(!$match){
            return response()->json([
                'status_code' => '401',
                'message' => 'Wrong login info',
                'code' => "fh2119518141520221129412054nuf"
            ], 401);
        }

        $user_data = User::where('user_name', $data['username'])->orWhere('email', $data['username'])->first();

        return response()->json([
            'status_code' => '200',
            'message' => 'User found',
            'code' => "fh2119518221129412054uf",
            'data' => [
                'username' => $user_data['user_name'],
                'email' => $user_data['email']
            ]
        ], 200);
    }
}

