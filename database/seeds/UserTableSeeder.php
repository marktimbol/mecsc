<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = factory(App\User::class)->create([
        	'name'	=> 'Mark Timbol',
        	'email'	=> 'mark@timbol.com',
        	'password'	=> bcrypt('marktimbol')
        ]);

        // $admin->roles()->attach([1, 4]); //Staff, Administrator
        
        factory(App\User::class, 10)->create();
    }
}
