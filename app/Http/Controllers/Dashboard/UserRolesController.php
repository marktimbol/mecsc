<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Jobs\ReindexAlgolia;
use App\User;
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
        dispatch(new ReindexAlgolia);

        $user = $this->user->find($user->id);
    	return $user->roles;
    }

    public function destroy($user, $role)
    {
    	$user->removeRole($role->id);
        dispatch(new ReindexAlgolia);
        
        $user = $this->user->find($user->id);
    	return $user->roles;
    }

}
