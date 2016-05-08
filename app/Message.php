<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['thread_id', 'user_id', 'message'];

    public function threads()
    {
    	return $this->belongsTo(Thread::class);
    }
}
