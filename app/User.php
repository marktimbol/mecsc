<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use AlgoliaSearch\Laravel\AlgoliaEloquentTrait;

class User extends Authenticatable
{
    use AlgoliaEloquentTrait;
    use AddRemoveAlgoliaRecord;

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

    public static $autoIndex = false;
    public static $autoDelete = false;
    
    public $indices = ['mecsc_speakers'];

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
        $this->addToAlgolia($role_id);
        return $this->roles()->attach($role_id);
    }

    public function removeRole($role_id)
    {
        $this->removeFromAlgolia($role_id);
        return $this->roles()->detach($role_id);
    }
}
