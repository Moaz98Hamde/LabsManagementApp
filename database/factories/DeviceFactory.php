<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Device;

$factory->define(App\Device::class, function (Faker $faker) {
    return [
        "description" => $faker->sentence(3),
    ];
});