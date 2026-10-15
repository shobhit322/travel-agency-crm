<?php

use App\Filament\Resources\SaasLeadResource;
use App\Models\Customer;
use App\Models\SaasLead;
use App\Models\SuperAdmin;
use App\Models\Tenant;
use App\Models\TenantUser;
use App\Services\DemoRequests;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

/**
 * A complete, valid submission whose form token was issued long enough ago to pass the
 * minimum-fill-time check.
 *
 * @param  array<string, mixed>  $overrides
 * @return array<string, mixed>
 */
function demoPayload(array $overrides = []): array
{
    return array_merge([
        'name' => 'Asha Rao',
        'email' => 'asha@sunrise-travel.test',
        'company' => 'Sunrise Travel',
        'phone' => '+91 98765 43210',
        'team_size' => '6-20',
        'message' => 'We would like to see invoicing.',
        'consent' => '1',
        'contact_website' => '',
        'form_token' => app(DemoRequests::class)->issueToken(),
    ], $overrides);
}

test('the public homepage is branded as VI Studio Travel CRM with the official logo', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('VI Studio Travel CRM')
        ->assertSee('brand/vi-studio-logo', false)
        ->assertSee('brand/favicon', false)
        ->assertSee('Request a demo')
        ->assertDontSee('Laravel');
});

test('the official logo and favicon files are served from public/brand', function () {
    foreach (['vi-studio-logo.png', 'vi-studio-logo-320.png', 'favicon.ico', 'favicon-32.png', 'apple-touch-icon.png', 'vi-studio.css', 'site.css', 'site.js'] as $file) {
        expect(is_file(public_path("brand/{$file}")))->toBeTrue("public/brand/{$file} is missing");
    }

    expect(getimagesize(public_path('brand/vi-studio-logo.png')))->toMatchArray([0 => 1080, 1 => 923]);
});

test('the request-a-demo page shows the form', function () {
    $this->get('/request-demo')
        ->assertOk()
        ->assertSee('name="email"', false)
        ->assertSee('name="consent"', false)
        ->assertSee('name="form_token"', false);
});

test('the Super Admin sign-in screen is branded and links to the demo request', function () {
    $this->get('/admin/login')
        ->assertOk()
        ->assertSee('brand/vi-studio-logo', false)
        ->assertSee('brand/vi-studio.css', false)
        ->assertSee('Request a demo')
        ->assertSee(route('demo.create'), false);
});

test('a valid demo request becomes a new SaaS lead and creates no accounts', function () {
    $payload = demoPayload();
    $this->travel(10)->seconds();

    $this->post('/request-demo', $payload)->assertRedirect(route('demo.thanks'));

    $lead = SaasLead::query()->sole();

    expect($lead->name)->toBe('Asha Rao')
        ->and($lead->email)->toBe('asha@sunrise-travel.test')
        ->and($lead->company)->toBe('Sunrise Travel')
        ->and($lead->status)->toBe('new')
        ->and($lead->source)->toBe(DemoRequests::SOURCE)
        ->and($lead->notes)->toContain('+91 98765 43210')->toContain('6–20 people')->toContain('invoicing');

    expect(SuperAdmin::query()->count())->toBe(0)
        ->and(TenantUser::query()->withoutGlobalScopes()->count())->toBe(0)
        ->and(Customer::query()->withoutGlobalScopes()->count())->toBe(0)
        ->and(Tenant::query()->count())->toBe(0);

    $this->get(route('demo.thanks'))->assertOk()->assertSee('Thank you');
});

test('a repeat request from the same email adds to the existing lead instead of duplicating it', function () {
    SaasLead::query()->create(['name' => 'Existing', 'email' => 'asha@sunrise-travel.test', 'status' => 'contacted', 'source' => 'referral']);
    $payload = demoPayload(['email' => 'ASHA@Sunrise-Travel.test']);
    $this->travel(10)->seconds();

    $this->post('/request-demo', $payload)->assertRedirect(route('demo.thanks'));

    $lead = SaasLead::query()->sole();

    expect($lead->status)->toBe('contacted')
        ->and($lead->name)->toBe('Existing')
        ->and($lead->notes)->toContain('Demo request');
});

test('invalid details are rejected and sent back to the form with errors', function () {
    $payload = demoPayload(['email' => 'not-an-email', 'consent' => null, 'company' => '']);
    $this->travel(10)->seconds();

    $this->from('/')->post('/request-demo', $payload)
        ->assertRedirect(route('demo.create'))
        ->assertSessionHasErrors(['email', 'company', 'consent']);

    expect(SaasLead::query()->count())->toBe(0);
});

test('a filled honeypot looks like a success but stores nothing', function () {
    $payload = demoPayload(['contact_website' => 'https://spam.example']);
    $this->travel(10)->seconds();

    $this->post('/request-demo', $payload)->assertRedirect(route('demo.thanks'));

    expect(SaasLead::query()->count())->toBe(0);
});

test('submissions that are instant, tampered with or missing the form token are rejected', function () {
    $instant = demoPayload();
    $this->post('/request-demo', $instant)
        ->assertRedirect(route('demo.create'))
        ->assertSessionHasErrors('form_token');

    $this->travel(10)->seconds();
    $this->post('/request-demo', demoPayload(['form_token' => 'tampered']))->assertSessionHasErrors('form_token');
    $this->post('/request-demo', demoPayload(['form_token' => null]))->assertSessionHasErrors('form_token');

    expect(SaasLead::query()->count())->toBe(0);
});

test('the demo form is rate limited per client', function () {
    $payloads = array_map(fn (int $attempt): array => demoPayload(['email' => "visitor{$attempt}@example.test"]), range(1, 4));
    $this->travel(10)->seconds();

    foreach (array_slice($payloads, 0, 3) as $payload) {
        $this->post('/request-demo', $payload)->assertRedirect(route('demo.thanks'));
    }

    $this->post('/request-demo', $payloads[3])->assertTooManyRequests();
});

test('the SaaS leads menu item shows how many demo requests are waiting', function () {
    expect(SaasLeadResource::getNavigationBadge())->toBeNull();

    SaasLead::query()->create(['name' => 'A', 'email' => 'a@example.test', 'status' => 'new']);
    SaasLead::query()->create(['name' => 'B', 'email' => 'b@example.test', 'status' => 'converted']);

    expect(SaasLeadResource::getNavigationBadge())->toBe('1');
});
