<?php

namespace App\Http\Controllers;

use App\Notifications\SignupActivate;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;
class RegisterController extends Controller
{
    /**
     * Handles Registration Request
     */
    public $successStatus = 200;

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [ //basically checks that these fields are present
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'registration_number' => 'required',
            'department' => 'required',
            'contact_number' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'registration_number' => $request -> registration_number,
            'department' => $request -> department,
            'contact_number' =>$request -> contact_number,
            'activation_token' => Str::random(60)
        ]);

        $user->notify(new SignupActivate($user));

        $output['token'] = $user->createToken('nyanradio')->accessToken;
        return response()->json(['output' => $output], $this->successStatus);
    }

    public function signupActivate($token) //changes the userstatus  after mail verification
    {
        $user = User::where('activation_token', $token)->first();
        if (!$user) {
            return response()->json([
                'message' => __('auth.token_invalid or account already activated!')
            ], 404);
        }
        $user->active = true;
        $user->activation_token = '';
        $user->save(); // creates a validated user in the database
        return $user;
    }

}
