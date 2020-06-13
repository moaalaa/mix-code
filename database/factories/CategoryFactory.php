<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use MixCode\Category;
use Faker\Generator as Faker;
use MixCode\User;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'en_name'           => $faker->name,
        'ar_name'           => $faker->name,
        'status'            => Category::ACTIVE_STATUS,
        'creator_id'        => User::first()->id,
        'deleted_at'        => null,
    ];
});
