<?php

namespace Mecsc\Repositories;

use App\Agenda;
use App\Schedule;
use Mecsc\Contracts\AgendaInterface;

class AgendaRepository implements AgendaInterface {

	public function all()
	{
		return Agenda::all();
	}
	
	public function find($id)
	{
		return Agenda::findOrFail($id);
	}

	public function store($data)
	{
		$schedule = Schedule::findOrFail($data['schedule_id']);

		$agenda = new Agenda;
		$agenda->time = $data->time;
		$agenda->title = $data->title;
		$agenda->venue = $data->venue;
		$agenda->description = $data->description;

		return $schedule->agendas()->save($agenda) ? true : false;
	}

	public function delete($agenda)
	{
		return $agenda->delete();
	}
}