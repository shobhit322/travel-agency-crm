<x-filament-widgets::widget>
    <div class="vi-welcome">
        <div>
            <h2>Welcome back, {{ $name }}</h2>
            <p>{{ config('branding.name') }} — {{ config('branding.tagline') }}. Here is how the platform is doing today.</p>
        </div>
        <div class="vi-welcome__actions">
            @foreach ($links as $label => $url)
                <a href="{{ $url }}">{{ $label }}</a>
            @endforeach
        </div>
    </div>
</x-filament-widgets::widget>
