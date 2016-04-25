<?php
namespace App;

trait AddRemoveContacts
{
	public function addContact($contact)
    {
        return $this->contacts()->attach($contact);
    }

    public function removeContact($contact)
    {
        return $this->contacts()->detach($contact);
    }
}