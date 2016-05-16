<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Participant;
use App\Thread;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserThreadsController extends Controller
{
	protected $user;

	public function __construct()
	{
		$this->user = Auth::guard('api')->user();
	}

    public function index()
    {
        return Thread::where('sender_id', $this->user->id)
                    ->OrWhere('receiver_id', $this->user->id)
                    ->get();
    }

    public function show($thread)
    {
    	return $thread;
    }
}
