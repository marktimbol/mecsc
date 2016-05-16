<?php

namespace App;

trait UserRelationships
{
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    public function messages()
    {
    	return $this->hasMany(Message::class, 'sender_id');
    }

    public function sentMessages()
    {
        return $this->belongsToMany(User::class, 'threads', 'sender_id', 'receiver_id')
                    ->withPivot('message')
                    ->withTimestamps();
    }

    public function receivedMessages()
    {
        return $this->belongsToMany(User::class, 'threads', 'receiver_id', 'sender_id')
                    ->withPivot('message')
                    ->withTimestamps();
    }
}