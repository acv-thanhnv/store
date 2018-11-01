<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Entities::class, function (Faker $faker) {
    return [
        'name' => 'Xin chào',
        'image' => $faker->image,
        'price' => $faker->numberBetween($min = 1000, $max = 90000),
    ];
});
