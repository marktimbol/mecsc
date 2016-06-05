<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
	protected $user;

	public function __construct()
	{
		$this->user = Auth::guard('api')->user();
	}

    public function haveConversation($user1, $user2)
    {
        $sender_id = $user1;
        $receiver_id = $user2;

        $result = Thread::where('sender_id', $sender_id)
                ->where('receiver_id', $receiver_id);

        if( $result->count() == 0 )
        {
            // Flip the condition
            $result = Thread::where('receiver_id', $sender_id)
                    ->where('sender_id', $receiver_id); 

            if( $result->count() == 0 ) {
                return response()->json([
                    'haveConversation' => false
                ]);
            }
        }

        return response()->json([
            'thread' => $result->orderBy('created_at', 'DESC')->first(),
            'haveConversation' => true
        ]);
    }
}
