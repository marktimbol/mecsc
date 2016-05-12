<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Participant;
use App\Thread;
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
    	$threadIds =  Participant::whereUserId($this->user->id)->lists('thread_id');
    	return Thread::findMany($threadIds);
    }

    public function show($thread)
    {
    	return $thread;
    }
}
