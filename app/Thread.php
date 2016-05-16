<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $fillable = ['sender_id', 'receiver_id', 'message'];
    
    protected $with = ['sender', 'receiver', 'messages'];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function messages()
    {
    	return $this->hasMany(Message::class);
    }

    // public function sentMessages()
    // {
    //     return $this->belongsToMany(User::class, 'threads', 'sender_id', 'receiver_id')
    //                 ->withPivot('message')
    //                 ->withTimestamps();
    // }
}
