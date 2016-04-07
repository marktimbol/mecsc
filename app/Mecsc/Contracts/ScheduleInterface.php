<?php

namespace Mecsc\Contracts;

interface ScheduleInterface {

	public function all();
	
	public function delete($id);
}