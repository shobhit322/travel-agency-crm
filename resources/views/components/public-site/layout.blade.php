@props(['title' => null])
@php
    use App\Support\PublicSite;
    use App\Support\TenantContext;
    use Illuminate\Support\Facades\Storage;

    $tenant = app(TenantContext::class)->get();
    $site = PublicSite::page($tenant);
    $contact = array_filter($site?->contact_settings ?? []);
    $accent = $site?->theme['accent_color'] ?? null;
    $accent = preg_match('/^#[0-9a-fA-F]{3,8}$/', (string) ($accent ?: $tenant->primary_color)) ? ($accent ?: $tenant->primary_color) : '#0f766e';
    $logoUrl = filled($tenant->logo) ? Storage::disk('public')->url($tenant->logo) : null;
    $nav = array_filter([
        'Group departures' => PublicSite::allows($tenant, PublicSite::GROUPS) ? route('public.departures.index') : null,
        'Gift vouchers' => PublicSite::allows($tenant, PublicSite::GIFTS) ? route('public.gift-vouchers.create') : null,
    ]);
    $email = $contact['email'] ?? $tenant->billing_email;
    $phone = $contact['phone'] ?? $tenant->phone_number ?? $tenant->mobile_number;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ? "{$title} — " : '' }}{{ $tenant->name }}</title>
    @if (filled($tenant->favicon))
        <link rel="icon" href="{{ Storage::disk('public')->url($tenant->favicon) }}">
    @endif
    <style>
        :root { color-scheme: dark; --accent: {{ $accent }}; --ink: #e5e7eb; --muted: #9ca3af; --line: #374151; --bg: #0a0a1a; --bg-card: #1e1e2d; --error: #b91c1c; --success: #15803d; --bg-success: #dcfce7; --bg-danger: #fee2e2; }
        * { box-sizing: border-box; }
        body { margin: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; color: var(--ink); background: var(--bg); line-height: 1.5; }
        a { color: var(--accent); }
        .wrap { max-width: 1080px; margin: 0 auto; padding: 0 20px; }
        header.site { background: var(--bg); border-bottom: 3px solid var(--accent); }
        header.site .wrap { display: flex; align-items: center; justify-content: space-between; gap: 16px; padding-top: 14px; padding-bottom: 14px; flex-wrap: wrap; }
        .brand { display: flex; align-items: center; gap: 12px; text-decoration: none; color: var(--ink); font-weight: 700; font-size: 18px; }
        .brand img { max-height: 48px; max-width: 170px; }
        nav a { margin-left: 18px; text-decoration: none; color: var(--ink); font-weight: 500; }
        nav a.active, nav a:hover { color: var(--accent); }
        main { padding: 32px 0 48px; }
        h1 { font-size: 30px; margin: 0 0 8px; }
        h2 { font-size: 20px; margin: 0 0 12px; }
        .lead { color: var(--muted); margin: 0 0 24px; }
        .card { background: var(--bg-card); border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,.07); padding: 22px; }
        .grid { display: grid; gap: 18px; grid-template-columns: repeat(auto-fill, minmax(290px, 1fr)); }
        .two-col { display: grid; gap: 24px; grid-template-columns: minmax(0, 1.6fr) minmax(0, 1fr); align-items: start; }
        .stack > * + * { margin-top: 18px; }
        .pill { display: inline-block; background: var(--bg-card); color: var(--ink); border-radius: 999px; padding: 2px 10px; font-size: 12px; font-weight: 600; }
        .price { font-size: 22px; font-weight: 700; }
        .muted { color: var(--muted); font-size: 14px; }
        .btn { display: inline-block; background: var(--accent); color: var(--ink); border: 0; border-radius: 8px; padding: 11px 18px; font-weight: 600; font-size: 15px; text-decoration: none; cursor: pointer; }
        .btn:hover { filter: brightness(.93); }
        .btn:disabled { opacity: .5; cursor: not-allowed; filter: none; }
        .btn.block { display: block; width: 100%; text-align: center; }
        .btn.ghost { background: transparent; color: var(--accent); border: 1px solid var(--accent); }
        table { width: 100%; border-collapse: collapse; font-size: 14px; }
        th { text-align: left; color: var(--muted); font-weight: 500; padding: 8px 6px; border-bottom: 1px solid var(--line); }
        td { padding: 10px 6px; border-bottom: 1px solid var(--line); vertical-align: middle; }
        ul.ticks { list-style: none; padding: 0; margin: 0; }
        ul.ticks li { padding: 4px 0 4px 26px; position: relative; }
        ul.ticks li::before { position: absolute; left: 0; font-weight: 700; }
        ul.ticks.yes li::before { content: '✓'; color: #15803d; }
        ul.ticks.no li::before { content: '✕'; color: #b91c1c; }
        label { display: block; font-weight: 600; font-size: 14px; margin-bottom: 4px; }
        input[type=text], input[type=email], input[type=tel], input[type=date], input[type=number], textarea, select {
            width: 100%; padding: 10px 12px; border: 1px solid #374151; border-radius: 8px; font: inherit; background: var(--bg-card); color: var(--ink);
        }
        textarea { min-height: 80px; }
        .field { margin-bottom: 14px; }
        .row2 { display: grid; gap: 12px; grid-template-columns: 1fr 1fr; }
        .check { display: flex; gap: 10px; align-items: flex-start; font-weight: 400; padding: 8px 0; border-bottom: 1px solid var(--line); }
        .check input { margin-top: 4px; }
        .check .grow { flex: 1; }
        .error { color: var(--error); font-size: 13px; margin-top: 4px; }
        .alert { background: #7f1d1d; color: #b91c1c; border-radius: 8px; padding: 12px 14px; margin-bottom: 16px; font-size: 14px; }
        .summary td { border: 0; padding: 4px 0; }
        .summary .total td { font-weight: 700; font-size: 16px; border-top: 1px solid var(--line); padding-top: 10px; }
        .summary .deposit td { font-weight: 700; color: var(--accent); }
        .sticky { position: sticky; top: 16px; }
        .step { display: flex; align-items: center; gap: 10px; }
        .step span { display: inline-grid; place-items: center; width: 28px; height: 28px; border-radius: 999px; background: var(--accent); color: var(--ink); font-size: 14px; }
        .req { color: #b91c1c; }
        input[readonly] { background: var(--bg-card); color: var(--ink); }
        .summary-card h2 { margin-bottom: 8px; }
        .summary .num { text-align: right; white-space: nowrap; }
        .summary .saved { color: var(--success); }
        .code-box { margin-top: 14px; }
        .code-row { display: flex; gap: 8px; }
        .code-row input { text-transform: uppercase; }
        .code-row .btn { padding: 9px 14px; }
        .code-msg { font-size: 13px; margin-top: 4px; min-height: 0; }
        .code-msg.ok { color: var(--success); }
        .code-msg.bad { color: var(--error); }
        footer.site { border-top: 1px solid var(--line); background: var(--bg); padding: 22px 0; font-size: 14px; color: var(--muted); }
        footer.site .wrap { display: flex; flex-wrap: wrap; gap: 8px 22px; }
        @media (max-width: 820px) {
            .two-col { grid-template-columns: 1fr; }
            .sticky { position: static; }
            nav a { margin: 0 14px 0 0; }
            .row2 { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <header class="site">
        <div class="wrap">
            <a class="brand" href="{{ $contact['website_url'] ?? $nav['Group departures'] ?? '#' }}">
                @if ($logoUrl)
                    <img src="{{ $logoUrl }}" alt="{{ $tenant->name }}">
                @else
                    {{ $tenant->name }}
                @endif
            </a>
            <nav>
                @foreach ($nav as $label => $url)
                    <a href="{{ $url }}" @class(['active' => url()->current() === $url])>{{ $label }}</a>
                @endforeach
            </nav>
        </div>
    </header>

    <main>
        <div class="wrap">
            {{ $slot }}
        </div>
    </main>

    <footer class="site">
        <div class="wrap">
            <strong style="color: var(--ink)">{{ $tenant->name }}</strong>
            @if ($contact['address'] ?? $tenant->address)<span>{{ $contact['address'] ?? $tenant->address }}</span>@endif
            @if ($phone)<span>{{ $phone }}</span>@endif
            @if ($contact['whatsapp'] ?? null)<a href="https://wa.me/{{ preg_replace('/\D/', '', $contact['whatsapp']) }}">WhatsApp</a>@endif
            @if ($email)<a href="mailto:{{ $email }}">{{ $email }}</a>@endif
            @if ($contact['facebook_url'] ?? null)<a href="{{ $contact['facebook_url'] }}" rel="noopener">Facebook</a>@endif
            @if ($contact['instagram_url'] ?? null)<a href="{{ $contact['instagram_url'] }}" rel="noopener">Instagram</a>@endif
        </div>
    </footer>
</body>
<script>
document.documentElement.classList.add('dark');
if (!localStorage.getItem('theme')) { localStorage.setItem('theme', 'dark'); }
</script>
</html>
