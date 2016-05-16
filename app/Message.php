<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['thread_id', 'sender_id', 'message'];
    
    protected $with = ['user'];

    public function user()
    {
    	return $this->belongsTo(User::class, 'sender_id');
    }

    public function thread()
    {
    	return $this->belongsTo(Thread::class);
    }
}
