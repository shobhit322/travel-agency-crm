<?php

use App\Enums\CustomerStatus;
use App\Models\Customer;
use App\Models\SuperAdmin;
use App\Models\Tenant;
use App\Models\TenantUser;
use App\Models\User;
use Database\Seeders\DemoAccountsSeeder;
use Database\Seeders\PermissionSeeder;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

test('demo accounts seeder creates persistent manager and user accounts and is idempotent', function () {
    // Seed initial tenant and permissions
    $tenant = Tenant::query()->create([
        'slug' => 'demo-travel',
        'name' => 'Demo Travel Agency',
        'billing_email' => 'billing@example.com',
    ]);

    $this->seed(PermissionSeeder::class);

    // Run seeder twice to verify idempotency (no duplicate key errors)
    $this->seed(DemoAccountsSeeder::class);
    $this->seed(DemoAccountsSeeder::class);

    // 1. Verify Manager Demo Account
    $managerUser = User::query()->where('email', 'manager@vistudio.com')->first();
    expect($managerUser)->not->toBeNull()
        ->and($managerUser->name)->toBe('Demo Manager')
        ->and(Hash::check('ManagerPassword123!', $managerUser->password))->toBeTrue();

    $managerAdmin = SuperAdmin::query()->where('email', 'manager@vistudio.com')->first();
    expect($managerAdmin)->not->toBeNull()
        ->and($managerAdmin->name)->toBe('Demo Manager')
        ->and($managerAdmin->status)->toBe('active')
        ->and(Hash::check('ManagerPassword123!', $managerAdmin->password))->toBeTrue();

    $managerStaff = TenantUser::query()->withoutGlobalScopes()->where('email', 'manager@vistudio.com')->first();
    expect($managerStaff)->not->toBeNull()
        ->and($managerStaff->name)->toBe('Demo Manager')
        ->and($managerStaff->status)->toBe('active')
        ->and(Hash::check('ManagerPassword123!', $managerStaff->password))->toBeTrue();

    // 2. Verify User / Client Demo Account
    $clientUser = User::query()->where('email' ,'user@vistudio.com')->first();
    expect($clientUser)->not->toBeNull()
        ->and($clientUser->name)->toBe('Demo User')
        ->and(Hash::check('UserPassword123!', $clientUser->password))->toBeTrue();

    $customer = Customer::query()->withoutGlobalScopes()->where('email', 'user@vistudio.com')->first();
    expect($customer)->not->toBeNull()
        ->and($customer->name)->toBe('Demo User')
        ->and($customer->status)->toBe(CustomerStatus::Active)
        ->and(Hash::check('UserPassword123!', $customer->password))->toBeTrue();

    // 3. Verify Panel Access
    $adminPanel = Filament::getPanel('admin');
    expect($managerAdmin->canAccessPanel($adminPanel))->toBeTrue();

    $tenantPanel = Filament::getPanel('tenant');
    expect($managerStaff->canAccessPanel($tenantPanel))->toBeTrue();

    $portalPanel = Filament::getPanel('portal');
    expect($customer->canAccessPanel($portalPanel))->toBeTrue();
});
