<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name', 'standNumber', 'description'];

    protected $with = ['roles'];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'company_roles');
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
