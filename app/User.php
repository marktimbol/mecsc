<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
        'designation', 'company', 'about'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $with = ['roles'];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    public function scopeSpeakers()
    {
        return static::whereHas('roles', function($query) {
            $query->whereTitle('Speaker');
        });
    }

    public function addRole($role_id)
    {
        return $this->roles()->attach($role_id);
    }

    public function removeRole($role_id)
    {
        return $this->roles()->detach($role_id);
    }
}
