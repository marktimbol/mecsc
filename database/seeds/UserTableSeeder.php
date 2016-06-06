<?php

use App\Jobs\ReindexAlgolia;
use Illuminate\Database\Seeder;
use Mecsc\Roles\Admin;
use Mecsc\Roles\Speaker;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mark = factory(App\User::class)->create([
        	'name'	=> 'Mark Timbol',
        	'email'	=> 'mark@timbol.com',
        	'password'	=> bcrypt('marktimbol')
        ]);
        (new Admin)->add($mark);

        $sabordo = factory(App\User::class)->create([
            'name'  => 'Sabordo',
            'email' => 'sabordo@timbol.com',
            'password'  => bcrypt('sabordo')
        ]);
        (new Speaker)->add($sabordo);

        dispatch(new ReindexAlgolia);
            
        factory(App\User::class, 10)->create();

        $speakers = factory(App\User::class, 10)->create();
        foreach( $speakers as $speaker )
        {
            (new Speaker)->add($speaker);
            dispatch(new ReindexAlgolia);
        }
    }
}
