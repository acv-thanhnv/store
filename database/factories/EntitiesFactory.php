<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Entities::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'image' => 'FoodImage/2/19.jpg',
        'price' => $faker->numberBetween($min = 1000, $max = 90000),
        'menu_id' => '10062',
    ];
});
