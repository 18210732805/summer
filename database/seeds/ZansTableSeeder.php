<?php

use Illuminate\Database\Seeder;

class ZansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(\App\Zan::class, 100)->create();
    }
}
