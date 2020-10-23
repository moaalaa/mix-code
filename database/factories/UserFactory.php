<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use MixCode\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Http\UploadedFile;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
         'full_name'             => $faker->firstName . ' ' . $faker->lastName,
        'email'                 => $faker->unique()->safeEmail,
        'email_verified_at'     => now(),
        'phone'                 => $faker->phoneNumber,
        'phone_code'            => '02',
        'password'              => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token'        => Str::random(10),
        'type'                  => 'customer',
        'status'                => 'active',
        'lang'                  => 'en',
 
        
        'deleted_at'            => null,
    ];
});
