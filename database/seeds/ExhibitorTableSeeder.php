<?php

use Illuminate\Database\Seeder;

class ExhibitorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Exhibitor::class, 20)->create();
    }
}
