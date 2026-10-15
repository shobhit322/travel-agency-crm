<?php

/*
|--------------------------------------------------------------------------
| Product branding
|--------------------------------------------------------------------------
|
| The product is VI Studio Travel CRM. These values are deliberately NOT read from APP_NAME, so the
| visible brand cannot drift when an environment still carries an older APP_NAME. Laravel and
| Filament stay the underlying technologies; only user-facing names and assets are branded here.
| The logo files live in public/brand (the official VI Studio logo and scaled copies of it).
|
*/

return [

    'name' => env('BRAND_NAME', 'VI Studio Travel CRM'),

    'short_name' => 'Travel CRM',

    'company' => 'Virtual Intelligence Studio',

    'tagline' => 'The intelligent CRM for modern travel agencies',

    'logo' => 'brand/vi-studio-logo.png',

    'logo_tiny' => 'brand/vi-studio-logo-160.png',

    'logo_small' => 'brand/vi-studio-logo-320.png',

    'logo_medium' => 'brand/vi-studio-logo-640.png',

    'favicon' => 'brand/favicon-32.png',

    'theme_color' => '#0a0d0f',

];
