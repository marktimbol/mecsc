<?php

namespace Mecsc\Repositories;

use App\User;
use Mecsc\Contracts\UserInterface;

class UserRepository implements UserInterface {

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
		return User::create($data->all()) ? true : false;
	}

	public function update($id, $data) {
		$user = User::findOrFail($id);
		$user->fill($data->all());

		return $user->save() ? true : false;
	}

	public function delete($id)
	{
		return User::findOrFail($id)->delete();
	}

	public function onlySpeakers()
	{
		$this->availableSpeakers = User::speakers();
		return $this;
	}

	public function except($ids)
	{
		$this->availableSpeakers = $this->availableSpeakers->whereNotIn('id', $ids);
		return $this;
	}
	
	public function get()
	{
		return $this->availableSpeakers->get();
	}
}