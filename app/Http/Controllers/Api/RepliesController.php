<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RepliesController extends Controller
{
	protected $user;

	public function __construct()
	{
		$this->user = Auth::guard('api')->user();
	}

    public function store(Request $request, $conversation)
    {
    	$message = new Message([
    		'user_id'	=> $this->user->id,
    		'message'	=> $request->message,
    	]);

    	return $this->user->replyTo($conversation, $message);
    }
}
