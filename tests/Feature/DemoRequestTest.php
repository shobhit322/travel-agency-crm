<?php

use Illuminate\Support\Facades\RateLimiter;

test('the public landing page displays VI Studio Travel CRM branding and demo request buttons', function () {
    $response = $this->get('/');

    $response->assertOk()
        ->assertSee('VI Studio Travel CRM')
        ->assertSee('vi-studio-logo.png')
        ->assertSee('vi-studio-favicon.jpg')
        ->assertSee('Request Demo');
});

test('the public landing page displays travel imagery and destinations showcase', function () {
    $response = $this->get('/');

    $response->assertOk()
        ->assertSee('Amalfi Coast')
        ->assertSee('Maldives Overwater')
        ->assertSee('Swiss Alps')
        ->assertSee('Serengeti')
        ->assertSee('Kyoto');
});

test('a visitor can submit a valid demo request', function () {
    RateLimiter::clear('demo-request:127.0.0.1');

    $response = $this->postJson(route('demo-request.store'), [
        'name' => 'Jane Traveler',
        'email' => 'jane@wanderlust.com',
        'company' => 'Wanderlust Expeditions',
        'message' => 'Looking for a CRM solution for 15 travel agents.',
    ]);

    $response->assertOk()
        ->assertJson([
            'success' => true,
            'message' => 'Thank you! Your demo request has been received. Our team will contact you shortly.',
        ]);
});

test('a demo request requires name and valid email', function () {
    RateLimiter::clear('demo-request:127.0.0.1');

    $response = $this->postJson(route('demo-request.store'), [
        'name' => '',
        'email' => 'not-an-email',
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['name', 'email']);
});

test('demo requests are rate limited after repeated submissions', function () {
    RateLimiter::clear('demo-request:127.0.0.1');

    foreach (range(1, 5) as $i) {
        $this->postJson(route('demo-request.store'), [
            'name' => "User {$i}",
            'email' => "user{$i}@example.com",
        ])->assertOk();
    }

    $response = $this->postJson(route('demo-request.store'), [
        'name' => 'User 6',
        'email' => 'user6@example.com',
    ]);

    $response->assertStatus(429)
        ->assertJson([
            'success' => false,
            'message' => 'Too many requests. Please try again later.',
        ]);
});

test('the admin login page renders VI Studio branding, demo request action, and properly sized icons', function () {
    $response = $this->get('/admin/login');

    $response->assertOk()
        ->assertSee('VI Studio Travel CRM')
        ->assertSee('vi-open-login-demo-modal')
        ->assertSee('vi-auth-btn-icon')
        ->assertSee('vi-auth-link-icon')
        ->assertSee('width="16"', false)
        ->assertSee('width="14"', false)
        ->assertSee('Request Demo Access')
        ->assertSee('Return to Public Website');
});
