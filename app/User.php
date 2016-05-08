<?php

namespace App;

use AlgoliaSearch\Laravel\AlgoliaEloquentTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Algolia;
    use AlgoliaEloquentTrait;
    use AddRemoveRoles;
    use UserRelationships;
    use UserThreads;

    protected $fillable = [
        'name', 'email', 'password', 'designation', 'company', 'about', 'api_token'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $with = ['roles'];

    public static $autoIndex = true;
    public static $autoDelete = true;
    
    public $indices = ['mecsc_users'];

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['api_token'] = str_random(60);
    }
}
