<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Location::class, function (Faker $faker) {
    return [
        'name' => $faker->numerify('Bàn ##'),
        'type_location_id' => '1',
        'active' => '1',
        'store_id' => '1',
    ];
});
