<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $fillable = ['subject'];
    protected $with = ['messages', 'participants'];

    public function messages()
    {
    	return $this->hasMany(Message::class);
    }

    public function participants()
    {
    	return $this->belongsToMany(User::class, 'participants');
    }
}
