<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\TemperatureRequest;
use App\Models\Request;
use Faker\Generator as Faker;

$factory->define(TemperatureRequest::class, function (Faker $faker) {
    return [
        
    ];
});

$factory->afterCreating(Request::class, function (TemperatureRequest $sr, Faker $faker){
    $sr->requests()->save(Factory(Request::class)->make());
});