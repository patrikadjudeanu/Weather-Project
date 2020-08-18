<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Request;
use Faker\Generator as Faker;

$factory->define(Request::class, function (Faker $faker) {
    return [
        'latitude' => $faker->randomFloat($nbMaxDecimals = 1, $min = -90, $max = 90),
        'longitude' => $faker->randomFloat($nbMaxDecimals = 1, $min = -180, $max = 180),
        'temperature' => $faker->randomFloat($nbMaxDecimals = 1, $min = -99.9, $max = 99.9),
        'location' => $faker->city() . ', ' . $faker->country(),
    ];
});


