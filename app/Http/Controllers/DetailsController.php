<?php

namespace App\Http\Controllers;

use App\Notifications\SignupActivate;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;

class DetailsController extends Controller
{

    public $successStatus = 200;


    /**
     * Returns Authenticated User Details
     */
    public function details()
    {
        return response()->json(['user' => auth()->User()], 200);
    }

 public function getName(){
        if(Auth::User()){
        return response()->json([
            'message' => Auth::getUser()->name
        ],200);}

        else {
            return response() ->json([
                'message' => 'User not logged in'
            ], 200);
        }
    }




}
