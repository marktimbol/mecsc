<?php

namespace Mecsc\Repositories;

use App\Speaker;
use Mecsc\Contracts\SpeakerInterface;

class SpeakerRepository implements SpeakerInterface {

	public function all()
	{
		return Speaker::latest()->get();
	}
	
	public function find($id)
	{
		return Speaker::findOrFail($id);
	}

	public function except($ids)
	{
		return Speaker::whereNotIn('id', $ids)->get();
	}

	public function store($data)
	{
		return Speaker::create($data->all()) ? true : false;
	}

	public function update($speaker, $data)
	{
		$speaker->fill($data->all());
		return $speaker->save() ? true : false;
	}

	public function delete($speaker)
	{
		return $speaker->delete();
	}
}