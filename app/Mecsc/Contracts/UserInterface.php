<?php

namespace Mecsc\Contracts;

interface UserInterface {

	public function all();

	public function find($id);
	
	public function store($data);

	public function update($id, $data);

	public function delete($id);

	public function onlySpeakers();

	public function get();

	public function except($ids);
}