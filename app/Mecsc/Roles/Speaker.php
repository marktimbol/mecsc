<?php
namespace Mecsc\Roles;

use App\User;

class Speaker
{
	public function all()
	{
		return User::whereHas('roles', function($query) {
			$query->where('role_id', 4);
		})->get();
	}

	public function add(User $user)
	{
		return $user->roles()->attach(4);
	}
}