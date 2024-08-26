<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class UserController extends Controller
{
    //

    public function createUser(Request $request)
    {
        $postData = $request->json()->all();


        //checking if these datas were passed in the request bodies
        if (!array_key_exists("userName", $postData) || !array_key_exists("firstName", $postData) || !array_key_exists("lastName", $postData) || !array_key_exists("email", $postData) || !array_key_exists("password", $postData)) {
            return response()->json([
                'status_code' => '422',
                'message' => 'Error, incomplete request data',
                'log' => $request
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
            return response()->json([
                'status_code' => '422',
                'message' => 'Error, incomplete or inconsistent request data',
                'Error' => $validator->errors()
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
}
