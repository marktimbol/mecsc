<?php

namespace Mecsc\Repositories;

use App\User;

class SpeakerRepository
{
	protected $availableSpeakers;

	public function all()
	{
		return User::all();
	}
	
	public function find($id)
	{
		return User::findOrFail($id);
	}

	public function store($data)
	{
		return User::create($data->all());
	}

	public function update($user, $data)
	{
		$user->fill($data->all());
		$user->save();
	}

	public function delete($user)
	{
		return $user->delete();
	}
}