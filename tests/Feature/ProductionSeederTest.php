<?php

use App\Models\SuperAdmin;
use Database\Seeders\ProductionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\PermissionRegistrar;

uses(RefreshDatabase::class);

function bootstrapAdminConfig(?string $email, ?string $password): void
{
    config(['platform.bootstrap_admin' => ['name' => 'Platform Admin', 'email' => $email, 'password' => $password]]);
}

test('the production seeder refuses to run without a strong bootstrap admin password', function () {
    bootstrapAdminConfig('owner@agency.test', 'too-short');

    expect(fn () => $this->seed(ProductionSeeder::class))->toThrow(RuntimeException::class);
    expect(SuperAdmin::query()->count())->toBe(0);

    bootstrapAdminConfig(null, null);

    expect(fn () => $this->seed(ProductionSeeder::class))->toThrow(RuntimeException::class);
});

test('the production seeder creates only the configured Super Admin, never the demo account', function () {
    bootstrapAdminConfig('owner@agency.test', 'a-strong-passphrase-1');

    $this->seed(ProductionSeeder::class);

    $admin = SuperAdmin::query()->where('email', 'owner@agency.test')->firstOrFail();

    app(PermissionRegistrar::class)->setPermissionsTeamId(0);
    expect(Hash::check('a-strong-passphrase-1', $admin->password))->toBeTrue()
        ->and($admin->hasRole('Super Admin'))->toBeTrue()
        ->and(SuperAdmin::query()->where('email', 'admin@example.com')->exists())->toBeFalse();
    app(PermissionRegistrar::class)->setPermissionsTeamId(null);
});

test('re-running the production seeder keeps an admin password that was changed since', function () {
    bootstrapAdminConfig('owner@agency.test', 'a-strong-passphrase-1');
    $this->seed(ProductionSeeder::class);

    SuperAdmin::query()->where('email', 'owner@agency.test')->firstOrFail()->update(['password' => 'a-different-passphrase-2']);

    $this->seed(ProductionSeeder::class);

    $admin = SuperAdmin::query()->where('email', 'owner@agency.test')->firstOrFail();

    expect(SuperAdmin::query()->count())->toBe(1)
        ->and(Hash::check('a-different-passphrase-2', $admin->password))->toBeTrue();
});
