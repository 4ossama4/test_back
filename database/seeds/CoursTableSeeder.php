<?php

use Illuminate\Database\Seeder;

class CoursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Course::class,15)->create();
    }
}
