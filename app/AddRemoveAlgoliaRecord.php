<?php
namespace App;

trait AddRemoveAlgoliaRecord
{
	private function addToAlgolia($role_id)
	{
	    if( $role_id == 4 )
	    {
	        $this->pushToIndex();
	    } 
	}

	private function removeFromAlgolia($role_id)
	{
	    if( $role_id == 4 )
	    {
	        $this->removeFromIndex();
	    } 
	}	
}
