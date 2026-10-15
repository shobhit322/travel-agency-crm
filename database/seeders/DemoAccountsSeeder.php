<?php

namespace Database\Seeders;

use App\Enums\CustomerStatus;
use App\Models\Country;
use App\Models\Customer;
use App\Models\SuperAdmin;
use App\Models\Tenant;
use App\Models\TenantUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class DemoAccountsSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // --------------------------------------------------------------------------
        // 1. Manager Demo Account
        // --------------------------------------------------------------------------
        // Name: Demo Manager
        // Email: manager@vistudio.com
        // Password: ManagerPassword123!
        // Access: Manager / Admin panel access

        $managerAdmin = SuperAdmin::query()->updateOrCreate(
            ['email' => 'manager@vistudio.com'],
            [
                'name' => 'Demo Manager',
                'password' => Hash::make('ManagerPassword123!'),
                'status' => 'active',
                'email_verified_at' => now(),
            ],
        );

        // Assign Super Admin role to manager admin
        app(PermissionRegistrar::class)->setPermissionsTeamId(0);
        $superAdminRole = Role::findOrCreate('Super Admin', 'super_admin');
        if (! $managerAdmin->hasRole($superAdminRole)) {
            $managerAdmin->assignRole($superAdminRole);
        }
        app(PermissionRegistrar::class)->setPermissionsTeamId(null);

        // Resolve or create default agency tenant
        $tenant = Tenant::query()->first();
        if (! $tenant) {
            $tenant = Tenant::query()->create([
                'slug' => 'vi-studio',
                'name' => 'VI Studio Travel CRM',
                'billing_email' => 'billing@vistudio.com',
            ]);
        }

        // Ensure TenantUser record exists for Agency Manager / Staff panel (/tenant)
        $managerStaff = TenantUser::query()->withoutGlobalScopes()->updateOrCreate(
            ['email' => 'manager@vistudio.com'],
            [
                'tenant_id' => $tenant->id,
                'name' => 'Demo Manager',
                'password' => Hash::make('ManagerPassword123!'),
                'status' => 'active',
                'designation' => 'Manager',
                'department' => 'Management',
                'email_verified_at' => now(),
            ],
        );

        app(PermissionRegistrar::class)->setPermissionsTeamId($tenant->id);
        $tenantOwnerRole = Role::findOrCreate('Tenant Owner', 'tenant');
        if (! $managerStaff->hasRole($tenantOwnerRole)) {
            $managerStaff->assignRole($tenantOwnerRole);
        }

        // --------------------------------------------------------------------------
        // 2. User / Client Demo Account
        // --------------------------------------------------------------------------
        // Name: Demo User
        // Email: user@vistudio.com
        // Password: UserPassword123!
        // Access: Client portal / user dashboard view

        // Ensure Customer record exists for Client portal (/portal)
        $defaultCountryId = Country::query()->where('iso2', 'NP')->value('id')
            ?? Country::query()->value('id');

        $customer = Customer::query()->withoutGlobalScopes()->updateOrCreate(
            [
                'tenant_id' => $tenant->id,
                'email' => 'user@vistudio.com',
            ],
            [
                'name' => 'Demo User',
                'password' => Hash::make('UserPassword123!'),
                'phone' => '+1 555 0199',
                'type' => 'individual',
                'nationality_id' => $defaultCountryId,
                'country_of_residence_id' => $defaultCountryId,
            ],
        );

        $customer->forceFill([
            'status' => CustomerStatus::Active,
            'email_verified_at' => $customer->email_verified_at ?? now(),
        ])->save();

        $customerRole = Role::findOrCreate('Customer', 'customer');
        if (! $customer->hasRole($customerRole)) {
            $customer->assignRole($customerRole);
        }
        app(PermissionRegistrar::class)->setPermissionsTeamId(null);
    }
}
