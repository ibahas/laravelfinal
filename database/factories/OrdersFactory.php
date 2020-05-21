<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Orders;
use Faker\Generator as Faker;

$factory->define(Orders::class, function (Faker $faker) {
    return [
        //
        'product' => Rand(1, 10),
        'user' => Rand(1, 10),
        'status' => Rand(0, 2),
        'trustee' => Rand(1, 10),
        'numbering' => Rand(1, 20),
    ];
});
