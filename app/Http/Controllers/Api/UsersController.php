<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
	protected $user;

	public function __construct()
	{
		$this->user = Auth::guard('api')->user();
	}

    public function hasCommunicated($user)
    {
        $thread = Thread::where('sender_id', $this->user->id)
                        ->where('receiver_id', $user->id);

        if( $thread->count() !== 0 )
        {
            return response()->json([
                'hasCommunicated' => true,
            ]);
        }

        return response()->json([
            'hasCommunicated' => false,
        ]);
    }
}
