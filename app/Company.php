<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use AddRemoveRoles;
    use AddRemoveContacts;

    protected $fillable = ['name', 'standNumber', 'description'];

    protected $with = ['roles', 'contacts'];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'company_roles');
    }

    public function contacts()
    {
        return $this->belongsToMany(User::class, 'company_contacts', 'company_id', 'contact_id');
    }
}
