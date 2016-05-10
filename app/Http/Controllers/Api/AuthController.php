<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getToken(Request $request)
    {
    	$credentials = [
    		'email'	=> $request->email,
    		'password'	=> $request->password
    	];

    	if( Auth::attempt($credentials) )
    	{
    		return response()->json([
    			'user' => Auth::user(),
    			'authenticated' => true,
    		]);
    	}

    	return response()->json([
            'user' => [
                'api_token' => '',
            ],
    		'authenticated' => false,
    	]);
    }
}
