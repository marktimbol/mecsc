<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
	use AddRemoveSpeaker;
	
	protected $fillable = [
		'time', 'venue', 'title', 'description'
	];

	protected $with = ['speakers'];

	public function schedule()
	{
		return $this->belongsTo(Schedule::class);
	}

	public function speakers()
	{
		return $this->belongsToMany(Speaker::class, 'agenda_speakers');
	}
}
