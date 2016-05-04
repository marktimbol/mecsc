<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;

class MessagesController extends Controller
{
	protected $user;

	public function __construct()
	{
		$this->user = Auth::guard('api')->user();
	}

    public function store(Request $request)
    {
    	dd($request->all());
    	$thread = new Thread([
    		'subject'	=> $request->subject
    	]);

    	Message::create([
    		'thread_id'	=> $thread->id,
    		'user_id'	=> $this->user->id,
    		'body'	=> $request->message
    	]);

    	//Sender
    	Participant::create([
    		'thread_id'	=> $thread->id,
    		'user_id'	=> $this->user->id,
    		'last_read'	=> new Carbon,
    	]);

    	//Recipients
    	if( $request->has('recipients') )
    	{
    		$thread->addParticipants($request->recipients);
    	}
    }
}
