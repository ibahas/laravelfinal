<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Products;
use Faker\Generator as Faker;

$factory->define(Products::class, function (Faker $faker) {
    return [
        //
        'title' => $faker->title(),
        'status' => rand(0,1),
        'description' => $faker->paragraph(),
        'user' => Rand(1,10),
        'photo' => '',
    ];
});
