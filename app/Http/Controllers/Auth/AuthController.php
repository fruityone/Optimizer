<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function login(Request $request){
    if(Auth::attempt(['username'=>$request->input('username'),'password'=>$request->input('password')])){
        $token = Auth::user()->createToken('Token');
        return response()->json(['token' => $token]);
    }

        else{
            return 401;
            }
        }
}
