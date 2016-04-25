<?php

namespace Mecsc\Contracts;

interface SpeakerInterface {

	public function all();

	public function except($ids);

	public function find($id);
	
	public function store($data);

	public function update($speaker, $data);

	public function delete($speaker);
}