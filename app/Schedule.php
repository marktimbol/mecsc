<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = ['eventDate', 'description'];

	protected $dates = ['eventDate'];
	protected $with = ['agendas'];

    public function agendas()
    {
    	return $this->hasMany(Agenda::class);
    }
}
