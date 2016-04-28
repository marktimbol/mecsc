<?php
namespace Mecsc;

use App\Conversation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StartConversation
{
	public function send(User $to, Request $request)
	{
		return Conversation::create([
			'from'	=> Auth::guard('api')->user()->id,
			'to'	=> $to->id,
			'message'	=> $request->message
		]);
	}
}