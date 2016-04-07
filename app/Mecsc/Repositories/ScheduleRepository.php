<?php

namespace Mecsc\Repositories;

use App\Schedule;
use Mecsc\Contracts\ScheduleInterface;

class ScheduleRepository implements ScheduleInterface {

	public function all()
	{
		return Schedule::with('agendas')->get();
	}

	public function store($data)
	{		
		return Schedule::create($data->all()) ? true : false;
	}

	public function delete($id)
	{
		return Schedule::findOrFail($id)->delete();
	}
}