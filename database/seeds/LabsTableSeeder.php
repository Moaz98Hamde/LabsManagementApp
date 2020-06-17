<?php

use Illuminate\Database\Seeder;
use App\Device;

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
              $lab->devices()->createMany( factory(App\Device::class, 10)->make()->toArray() );
        });;

    }
}