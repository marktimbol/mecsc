<?php
namespace App;

trait AddRemoveRoles
{
    public function addRole($role_id)
    {
        $this->roles()->attach($role_id);
    }

    public function removeRole($role_id)
    {
        $this->roles()->detach($role_id);       
    }
}