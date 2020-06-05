<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Device;
use App\Issue;

$factory->define(App\Issue::class, function (Faker $faker) {
    return [
        "device_id" => App\Device::all()->random(),
        "title" => $faker->word(),
        "description" => $faker->sentence(),
        "resolved" => $faker->boolean()
    ];
});