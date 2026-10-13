<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Bootstrap Platform Admin
    |--------------------------------------------------------------------------
    |
    | Read only by Database\Seeders\ProductionSeeder, which creates the first Super Admin on a
    | fresh production database. There is deliberately no default: DatabaseSeeder's demo admin
    | (admin@example.com / password) must never exist on a public deployment.
    |
    */

    'bootstrap_admin' => [
        'name' => env('PLATFORM_ADMIN_NAME', 'Platform Admin'),
        'email' => env('PLATFORM_ADMIN_EMAIL'),
        'password' => env('PLATFORM_ADMIN_PASSWORD'),
    ],

];
