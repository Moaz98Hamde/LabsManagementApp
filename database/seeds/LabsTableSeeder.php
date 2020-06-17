<?php

use Illuminate\Database\Seeder;
use App\Device;
use App\Issue;

class LabsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Lab::class, 10)->create()->each(function($lab){
            $devices = factory(App\Device::class, 10)->create()->each(function($device){
                 $device->issues()->createMany( factory(App\Issue::class, 3)->make()->toArray() );
            });

            $lab->devices()->saveMany($devices);

        });;

    }
}