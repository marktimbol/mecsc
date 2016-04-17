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

        $admin->roles()->attach(5); //Administrator

        $exhibitors = factory(App\User::class, 10)->create();
        foreach( $exhibitors as $user )
        {
            $user->roles()->attach(2); // 2 => Exhibitor
        }

        $sponsors = factory(App\User::class, 10)->create();
        foreach( $sponsors as $user )
        {
            $user->roles()->attach(3); // 3 => Sponsor
        }

        $speakers = factory(App\User::class, 10)->create();
        foreach( $speakers as $speaker )
        {
            $speaker->pushToIndex();
            $speaker->roles()->attach(4); // 4 => Speaker
        }
    }
}
