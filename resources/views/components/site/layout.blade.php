@props(['title' => null, 'description' => null, 'bodyClass' => ''])
@php
    $brand = config('branding.name');
    $pageTitle = $title ? "{$title} — {$brand}" : $brand.' — '.config('branding.tagline');
    $pageDescription = $description ?? 'VI Studio Travel CRM helps travel agencies manage bookings, customers, itineraries, invoices and payments in one place, with a branded portal for every traveller.';
    $css = \App\Filament\PlatformBranding::assetUrl('brand/site.css');
    $js = \App\Filament\PlatformBranding::assetUrl('brand/site.js');
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $pageDescription }}">
    <meta name="theme-color" content="{{ config('branding.theme_color') }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDescription }}">
    <meta property="og:image" content="{{ asset(config('branding.logo_medium')) }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('brand/favicon-32.png') }}">
    <link rel="icon" type="image/png" sizes="64x64" href="{{ asset('brand/favicon-64.png') }}">
    <link rel="shortcut icon" href="{{ asset('brand/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('brand/apple-touch-icon.png') }}">
    <link rel="stylesheet" href="{{ asset('fonts/filament/filament/inter/index.css') }}">
    <link rel="stylesheet" href="{{ $css }}">
    <script>document.documentElement.classList.add('js');</script>
</head>
<body class="{{ $bodyClass }}">
<a class="skip-link" href="#main">Skip to content</a>

<header class="site-header" data-header>
    <div class="container site-header__bar">
        <a class="site-brand" href="{{ route('home') }}" aria-label="{{ $brand }} — home">
            <img src="{{ asset(config('branding.logo_tiny')) }}" srcset="{{ asset(config('branding.logo_tiny')) }} 1x, {{ asset(config('branding.logo_small')) }} 2x" width="160" height="137" alt="{{ config('branding.company') }} logo">
            <span class="site-brand__text"><strong>{{ config('branding.short_name') }}</strong><small>by VI Studio</small></span>
        </a>

        <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="site-nav" data-nav-toggle>
            <span class="sr-only">Menu</span>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true"><path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
        </button>

        <nav class="site-nav" id="site-nav" aria-label="Main" data-nav>
            <a href="{{ route('home') }}#features">Features</a>
            <a href="{{ route('home') }}#how-it-works">How it works</a>
            <a href="{{ route('home') }}#benefits">Benefits</a>
            <a class="btn btn--ghost" href="{{ url('/admin/login') }}">Sign in</a>
            <a class="btn btn--primary" href="{{ route('demo.create') }}">Request a demo</a>
        </nav>
    </div>
</header>

<main id="main">
    {{ $slot }}
</main>

<footer class="site-footer">
    <div class="container site-footer__grid">
        <div>
            <a class="site-brand" href="{{ route('home') }}" aria-label="{{ $brand }} — home">
                <img src="{{ asset(config('branding.logo_tiny')) }}" srcset="{{ asset(config('branding.logo_tiny')) }} 1x, {{ asset(config('branding.logo_small')) }} 2x" width="160" height="137" alt="{{ config('branding.company') }} logo" loading="lazy">
                <span class="site-brand__text"><strong>{{ config('branding.short_name') }}</strong><small>by VI Studio</small></span>
            </a>
            <p class="site-footer__tag">{{ config('branding.tagline') }}.</p>
        </div>
        <nav aria-label="Footer">
            <h2>Explore</h2>
            <a href="{{ route('home') }}#features">Features</a>
            <a href="{{ route('home') }}#how-it-works">How it works</a>
            <a href="{{ route('home') }}#benefits">Benefits</a>
        </nav>
        <nav aria-label="Get started">
            <h2>Get started</h2>
            <a href="{{ route('demo.create') }}">Request a demo</a>
            <a href="{{ url('/admin/login') }}">Sign in</a>
        </nav>
    </div>
    <div class="container site-footer__legal">
        <span>© {{ now()->year }} {{ config('branding.company') }}. All rights reserved.</span>
        <span>{{ $brand }}</span>
    </div>
</footer>

<script src="{{ $js }}" defer></script>
</body>
</html>
