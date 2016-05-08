<?php

namespace App;

trait UserRelationships
{
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    public function threads()
    {
    	return $this->hasMany(Thread::class);
    }

    public function messages()
    {
    	return $this->hasMany(Message::class);
    }
}