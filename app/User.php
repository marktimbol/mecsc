<?php

namespace App;

use AlgoliaSearch\Laravel\AlgoliaEloquentTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use AlgoliaEloquentTrait;
    use Algolia;
    use AddRemoveRoles;

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

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    public function startConversation($conversation)
    {
        return Conversation::create($conversation);
    }

    public function replyTo(Conversation $conversation, Reply $reply)
    {

    }
}
