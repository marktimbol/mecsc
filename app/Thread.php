<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $fillable = ['from', 'user_id', 'subject'];
    protected $with = ['user', 'messages'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function messages()
    {
    	return $this->hasMany(Message::class);
    }

    public function participants()
    {
    	return $this->belongsToMany(User::class, 'participants');
    }
}
