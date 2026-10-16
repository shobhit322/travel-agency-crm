<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

try {
    // Force search path to central public schema
    DB::statement("SET search_path TO public;");

    // Create users table in public schema if missing
    DB::statement("
        CREATE TABLE IF NOT EXISTS users (
            id SERIAL PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) UNIQUE NOT NULL,
            email_verified_at TIMESTAMP NULL,
            password VARCHAR(255) NOT NULL,
            remember_token VARCHAR(100) NULL,
            created_at TIMESTAMP NULL,
            updated_at TIMESTAMP NULL
        );
    ");

    // Insert or update demo user in public schema
    $exists = DB::table('users')->where('email', 'demo@vistudio.com')->exists();

    if ($exists) {
        DB::table('users')->where('email', 'demo@vistudio.com')->update([
            'password' => Hash::make('DemoPassword123!'),
            'updated_at' => now(),
        ]);
        echo "SUCCESS: Public user password updated!\n";
    } else {
        DB::table('users')->insert([
            'name' => 'Demo User',
            'email' => 'demo@vistudio.com',
            'password' => Hash::make('DemoPassword123!'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        echo "SUCCESS: Public user created!\n";
    }
} catch (\Exception $e) {
    echo "Database error: " . $e->getMessage() . "\n";
}