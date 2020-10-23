<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use MixCode\Review;
use Faker\Generator as Faker;
use MixCode\Card;

$factory->define(Review::class, function (Faker $faker) {
    return [
        'name'          => $faker->name, 
        'email'         => $faker->safeEmail, 
        'review'        => $faker->paragraph,
        'rate'          => rand(1, 5),
        'card_id'    => factory(Card::class)->create()->id,
        'deleted_at'    => null,
    ];
});
