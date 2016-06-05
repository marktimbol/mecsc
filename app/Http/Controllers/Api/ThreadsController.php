<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Message;
use App\Participant;
use App\Thread;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThreadsController extends Controller
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

    public function show($thread)
    {
        return $thread->orderBy('created_at', 'DESC')->get();
    }

    public function store(Request $request)
    {
        return $this->user->startConversation($request->receiver_id, $request->message);
    }

    public function update(Request $request, $thread)
    {

    }

}
