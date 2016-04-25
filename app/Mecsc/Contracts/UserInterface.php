<?php

namespace Mecsc\Contracts;

interface UserInterface {

	public function all();

	public function find($id);
	
	public function store($data);

	public function update($user, $data);

	public function delete($user);
}