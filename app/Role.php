<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillables = ['title'];

    public function user()
    {
    	return $this->belongsToMany(User::class, 'user_roles');
    }
}
