<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Mecsc\Repositories\UserRepository;

class UserRolesController extends Controller
{
	protected $user;

	public function __construct(UserRepository $user)
	{
		$this->user = $user;
	}

    public function store(Request $request, $user)
    {	    	
    	$user->addRole($request->role_id);

    	$user = $this->user->find($user->id);
    	return $user->roles;
    }

    public function destroy($user, $role)
    {
    	$user->removeRole($role->id);
    	
    	$user = $this->user->find($user->id);
    	return $user->roles;
    }

}
