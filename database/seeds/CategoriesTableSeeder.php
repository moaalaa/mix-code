<?php

use Illuminate\Database\Seeder;
use MixCode\Category;
use MixCode\User;
use Illuminate\Support\Facades\Hash;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'en_name'             => 'Web Development',
            'ar_name'             => 'تطوير مواقع الكترونية',
            'status'              => 'active',
        ]);
    }
}
