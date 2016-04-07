<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
	protected $fillable = [
		'time', 'venue', 'title', 'description'
	];

	protected $with = ['speakers'];

	public function schedule()
	{
		return $this->belongsTo(Schedule::class);
	}
	
	public function categories()
	{
		return $this->belongsToMany(Category::class, 'agenda_categories');
	}

	public function speakers()
	{
		return $this->belongsToMany(User::class, 'agenda_speakers');
	}
}
