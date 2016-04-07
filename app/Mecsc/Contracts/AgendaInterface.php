<?php

namespace Mecsc\Contracts;

interface AgendaInterface {

	public function all();

	public function find($id);
	
	public function store($data);

	public function delete($id);
}