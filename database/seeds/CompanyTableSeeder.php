<?php

use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Company::class, 20)->create();
        factory(App\Exhibitor::class, 20)->create();
        factory(App\Media::class, 20)->create();
    }
}
