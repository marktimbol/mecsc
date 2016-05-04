<?php

namespace App\Http\Controllers\Api;

use App\Conversation;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversationsController extends Controller
{
	protected $user;

	public function __construct()
	{
		$this->user = Auth::guard('api')->user();
	}

    public function index()
    {
        return $this->user->messages;
    }

    public function show($conversation)
    {
        return $conversation;
    }

    public function store(Request $request)
    {
        $conversation = Conversation::create([
            'subject'   => $request->subject,
        ]);

        $user = User::findOrFail($request->to);
        
        return $this->user->startConversation($user, $conversation);
    }

    public function update(Request $request, $conversation)
    {

    }
}
