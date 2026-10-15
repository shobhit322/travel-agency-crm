<span class="vi-brand">
    <img
        class="vi-brand__mark"
        src="{{ asset(config('branding.logo_small')) }}"
        srcset="{{ asset(config('branding.logo_small')) }} 320w, {{ asset(config('branding.logo_medium')) }} 640w"
        sizes="(max-width: 640px) 160px, 320px"
        width="320"
        height="274"
        alt="{{ config('branding.company') }} logo"
    >
    <span class="vi-brand__text">
        <strong>{{ config('branding.short_name') }}</strong>
        <small>by VI Studio</small>
    </span>
</span>
