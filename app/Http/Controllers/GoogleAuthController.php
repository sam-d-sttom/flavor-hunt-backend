<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleAuthController extends Controller
{
    //
    public function handleGoogleCallBack(Request $request)
    {
        try {
            //Get user information using token
            $googleUser = Socialite::driver('google')->userFromToken(token: $request->access_token);

            
            $user = User::updateOrCreate([
                'google_id' => $googleUser->id,
            ], [
                'user_name' => $googleUser->nickname,
                'last_name' => $googleUser->user["family_name"],
                'first_name' => $googleUser->user["given_name"],
                'email' => $googleUser->email,
            ]);

            Auth::login($user);
            
            return response()->json(['data' => $googleUser]);
            
        } catch (Exception $e) {
            return response()->json(['data' => $e]);
        }
    }
}
