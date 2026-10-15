<?php

use App\Models\SuperAdmin;
use App\Models\Tenant;
use App\Models\TenantUser;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('the Super Admin panel carries the VI Studio logo, name and theme', function () {
    $this->seed();
    $admin = SuperAdmin::query()->where('email', 'admin@example.com')->firstOrFail();

    $this->actingAs($admin, 'super_admin')->get('/admin')
        ->assertOk()
        ->assertSee('brand/vi-studio-logo-320.png', false)
        ->assertSee('brand/vi-studio.css', false)
        ->assertSee('brand/favicon-32.png', false)
        ->assertSee('Welcome back, '.$admin->name)
        ->assertSee('Demo requests')
        ->assertSee('VI Studio Travel CRM');
});

test('agency panels keep the agency name as their brand and add a VI Studio powered-by line', function () {
    Tenant::query()->create(['name' => 'Demo Travel Agency', 'slug' => 'demo-travel']);
    $tenant = Tenant::query()->where('slug', 'demo-travel')->firstOrFail();

    $this->get(portalUrl($tenant, '/tenant/login'))
        ->assertOk()
        ->assertSeeInOrder(['fi-logo', 'Demo Travel Agency'], false)
        ->assertSee('brand/vi-studio.css', false)
        ->assertSee('Powered by')
        ->assertSee('VI Studio Travel CRM');
});

test('the staff dashboard of an agency keeps working with the shared theme', function () {
    $this->seed();
    $staff = TenantUser::query()->withoutGlobalScopes()->where('email', 'staff@example.com')->firstOrFail();

    $this->actingAsStaff($staff)->get('/tenant')
        ->assertOk()
        ->assertSee('brand/vi-studio.css', false);
});

test('the maintenance and agency-link pages are branded VI Studio Travel CRM', function () {
    $this->get('/tenant/login')
        ->assertSee('brand/favicon-32.png', false)
        ->assertSee('VI Studio Travel CRM');
});
