<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;

class LoginController extends Controller
{
    /**
     * Handles Login Request
     */
    public function login(Request $request)
    {
        $request->validate([ //checks whether these fields are present
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = [   //creates an object
            'email' => $request-> email,
            'password' => $request->password,
            'active' => 1, //verified
            'deleted_at' => null
        ];

        if (auth()->attempt($credentials)) {

            $output['token'] = auth()->user()->createToken('nyanradio')->accessToken;
            $output['email'] = $credentials ['email'];
            return response()->json(['output' => $output], 200); //will show the token and user's email
        } else {
            return response()->json(['error' => 'UnAuthorised'], 401);
        }
    }

    /**
     * Logout user (Revoke the token)
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
       $accessToken = auth() -> user() ->token();
       $accessToken ->revoke();

        return response()->json([
           'message' => 'Successfully logged out'
        ],200);
    }
}
