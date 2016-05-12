<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
	protected $fillable = ['thread_id', 'user_id'];

	protected $with = ['threads'];

	public function threads()
	{
		return $this->belongsToMany(Thread::class, 'participants', 'thread_id');
	}
}
