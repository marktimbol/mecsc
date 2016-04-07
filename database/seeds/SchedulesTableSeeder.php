<?php

use Illuminate\Database\Seeder;

class SchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $schedules = factory(App\Schedule::class, 3)->create([
            'description' => 'All delegates do something.'
        ]);

        foreach( $schedules as $schedule ) {
        	factory(App\Agenda::class, 10)->create([
        		'schedule_id' => $schedule->id
        	]);
        }
    }
}
