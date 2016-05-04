<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['conversation_id', 'user_id', 'message'];

    public function conversation()
    {
    	return $this->belongsTo(Conversation::class);
    }
}
