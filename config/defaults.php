<?php

/*
|--------------------------------------------------------------------------
| Application Defaults From A To Z
|--------------------------------------------------------------------------
|
| Use This Values In When You Need Default Values.
|
*/

return [
    
    /*
    |--------------------------------------------------------------------------
    | Settings
    |--------------------------------------------------------------------------
    |
    | Here Our Default Settings, That Shipped With This Project.
    |
    */

    'settings' => [
        'name'      => env('APP_NAME'),
        'email'     => 'email@example.com',
        'address'   => 'address',
        'phone'     => '00000000000',
    ],

    /*
    |--------------------------------------------------------------------------
    | Main Branch
    |--------------------------------------------------------------------------
    |
    | Here Our Default Main Branch, That Shipped With This Project.
    |
    */

    'main_branch' => [
        'en_name'       => 'Head Office',
        'ar_name'       => 'المقر الرئيسي',
        'en_address'    => 'Address',
        'ar_address'    => 'العنوان',
        'email'         => 'example@email.com',
    ],

];