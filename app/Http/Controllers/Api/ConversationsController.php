<?php

namespace App\Http\Controllers\Api;

use App\Conversation;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversationsController extends Controller
{
	protected $user;

	public function __construct()
	{
		$this->user = Auth::guard('api')->user();
	}

    public function store(Request $request, $user)
    {
        $message = [
            'from'  => $this->user->id,
            'to'    => $user->id,
            'message'   => $request->message,
        ];

    	return $this->user->startConversation($message);
    }
}
