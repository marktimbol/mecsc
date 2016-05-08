<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$roles = [
    		'Staff',
    		'Exhibitor',
    		'Sponsor',
            'Speaker',
            'Administrator'
    	];	

    	foreach( $roles as $role )
    	{
    		$record = new Role;
    		$record->title = $role;
    		$record->save();
    	}
    }
}
