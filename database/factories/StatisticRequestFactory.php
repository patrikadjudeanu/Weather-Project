<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\StatisticRequest;
use App\Models\Request;
use Faker\Generator as Faker;

$factory->define(StatisticRequest::class, function (Faker $faker) {
    return [
        'start_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'end_date' => now('Y-m-d'),
    ];
});

$factory->afterCreating(StatisticRequest::class, function (StatisticRequest $sr, Faker $faker){
    $sr->requests()->save(Factory(Request::class)->make());
});
