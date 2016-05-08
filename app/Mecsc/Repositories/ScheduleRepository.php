<?php

namespace Mecsc\Repositories;

use App\Schedule;
use Mecsc\Contracts\ScheduleInterface;

class ScheduleRepository implements ScheduleInterface {

	public function all()
	{
		return Schedule::all();
	}

	public function store($data)
	{		
		return Schedule::create($data->all()) ? true : false;
	}

	public function delete($schedule)
	{
		return $schedule->delete();
	}
}