<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $fillable = ['sender_id', 'receiver_id', 'message'];
    
    protected $with = ['messages'];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    public function messages()
    {
    	return $this->hasMany(Message::class);
    }

    // public function participants()
    // {
    // 	return $this->belongsToMany(User::class, 'participants');
    // }
}
