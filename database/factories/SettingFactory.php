<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use MixCode\Setting;
use Faker\Generator as Faker;

$factory->define(Setting::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'map_url' => $faker->url,
    ];
});
