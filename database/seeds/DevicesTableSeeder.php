<?php

use Illuminate\Database\Seeder;

class DevicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Device::class,10)->create()->each(function($device){
            $device->issues()->createMany(factory(App\Issue::class, 3)->make()->toArray());
        });
    }
}
