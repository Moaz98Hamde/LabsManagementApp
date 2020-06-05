<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Lab;

$factory->define(App\Lab::class, function (Faker $faker) {
    return [
        "name" => $faker->randomElement(['a','b','c']) . $faker->randomElement([1,2,3]),
        "capacity" => 30,
        "program" => null,
        "supervisor" => $faker->name(),
        "location" => $faker->sentence()
    ];
});