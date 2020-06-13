<?php

use Illuminate\Database\Seeder;
use MixCode\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'full_name'         => 'Admin ',
            'email'             => 'admin@example.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('123123'),
            'phone'             => '12345678901',
            'type'              => User::ADMIN_TYPE,
        ]);
    }
}
