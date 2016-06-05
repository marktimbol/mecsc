<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
    	$credentials = [
    		'email'	=> $request->email,
    		'password'	=> $request->password
    	];

    	if( Auth::attempt($credentials) )
    	{
            return Auth::user();
    		// return response()->json([
    		// 	'user' => Auth::user(),
    		// 	'authenticated' => true,
    		// ]);
    	}

    	return response()->json([
    		'api_token' => '',
    	]);
    }
}
