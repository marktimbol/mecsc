<?php

namespace Mecsc\Repositories;

use App\Speaker;
use Mecsc\Contracts\SpeakerInterface;

class SpeakerRepository implements SpeakerInterface {

	public function all()
	{
		return Speaker::all();
	}

	public function except($ids)
	{
		return Speaker::whereNotIn('id', $ids)->get();
	}
	
	public function find($id)
	{
		return Speaker::findOrFail($id);
	}

	public function store($data)
	{

	}

	public function delete($id)
	{
		return Speaker::findOrFail($id)->delete();
	}
}