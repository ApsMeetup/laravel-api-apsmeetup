<?php

use Faker\Generator as Faker;

$factory->define(APSMeetup\Models\Product::class, function (Faker $faker) {
    return [
        'name' => ucfirst($faker->unique()->sentence(2)),
        'description' =>  ucfirst($faker->unique()->sentence(3)),
        'price' => $faker->randomFloat(2,0,1000)
    ];
});
