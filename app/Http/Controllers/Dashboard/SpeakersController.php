<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use Mecsc\Contracts\UserInterface;

class SpeakersController extends Controller
{
	protected $user;

	public function __construct(UserInterface $user)
	{
		$this->user = $user;
	}

    public function index()
    {
    	$speakers = $this->user->onlySpeakers()->get();
    	return view('dashboard.speakers.index', compact('speakers'));
    }
}
