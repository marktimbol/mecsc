<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['thread_id', 'user_id', 'message'];
    protected $with = ['user'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
