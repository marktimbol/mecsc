<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Message;
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
        $thread = Thread::create([
            'subject'   => $request->subject,
        ]);

        $toUser = User::findOrFail($request->to);
        return $this->user->startConversation($toUser, $thread);
    }

    public function update(Request $request, $thread)
    {

    }
}
