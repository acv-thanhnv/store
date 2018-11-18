<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Menu::class, function (Faker $faker) {
    return [
        'name'=>$faker->numerify('Danh mục ###'),
        'store_id'=>$faker->numberBetween(1,1000),
        'description'=>$faker->sentence($nbWords = 6, $variableNbWords = true),
    ];
});
