<?php

use App\Models\GiftVoucher;
use App\Models\Tenant;
use App\Support\TenantContext;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('the cron endpoint is disabled until a cron secret is configured', function () {
    config(['services.cron.secret' => null]);

    $this->get('/internal/cron/daily')->assertNotFound();
});

test('the cron endpoint rejects a missing or wrong bearer token', function () {
    config(['services.cron.secret' => 'a-long-random-cron-secret']);

    $this->get('/internal/cron/daily')->assertUnauthorized();
    $this->withHeader('Authorization', 'Bearer not-the-secret')->get('/internal/cron/daily')->assertUnauthorized();
});

test('the cron endpoint only accepts the known tasks', function () {
    config(['services.cron.secret' => 'a-long-random-cron-secret']);

    $this->withHeader('Authorization', 'Bearer a-long-random-cron-secret')
        ->get('/internal/cron/migrate')
        ->assertNotFound();
});

test('the daily task runs the daily commands', function () {
    config(['services.cron.secret' => 'a-long-random-cron-secret']);

    $tenant = Tenant::query()->create(['name' => 'Northwind Travel', 'slug' => 'northwind-travel', 'currency' => 'USD']);
    app(TenantContext::class)->set($tenant);

    $expired = GiftVoucher::query()->create([
        'code' => 'GV-CRON-EXPIRED', 'value' => 5000, 'currency' => 'USD',
        'status' => 'unredeemed', 'expires_at' => now()->subDay(),
    ]);

    $this->withHeader('Authorization', 'Bearer a-long-random-cron-secret')
        ->get('/internal/cron/daily')
        ->assertOk()
        ->assertJsonPath('task', 'daily')
        ->assertJsonPath('status', 'ok')
        ->assertJsonPath('exit_codes.app:expire-gift-vouchers', 0);

    expect($expired->refresh()->status)->toBe('expired');
});
