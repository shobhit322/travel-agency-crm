@php
    $features = [
        ['Bookings & itineraries', 'Create and track bookings from enquiry to return flight, with travellers, schedules, add-ons and live price calculation.', 'M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5'],
        ['Packages & group departures', 'Publish tour packages and fixed departures with seat capacity, waitlists, promo codes and group-discount tiers.', 'M9 6.75V15m6-6v8.25m.503 3.498 4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 0 0-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0Z'],
        ['Customers & leads', 'One CRM for enquiries, leads and customers, with notes, history and a full activity log of who changed what.', 'M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z'],
        ['Invoices & online payments', 'Issue invoices, share no-login payment links and record payments, with payment gateways configured per agency.', 'M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z'],
        ['Traveller portal', 'Give every customer a sign-in to see their bookings, invoices and documents, and to manage their own details.', 'M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z'],
        ['Travel documents', 'Collect passports, visas and insurance per booking or traveller, and download everything in a single zip.', 'M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z'],
        ['Email campaigns', 'Send branded campaigns and system emails from your own templates, with one-click unsubscribe built in.', 'M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75'],
        ['Branded for every agency', 'Each agency gets its own address, logo and colours, with separate staff, roles and permissions.', 'M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z'],
    ];

    $benefits = [
        ['Save hours every week', 'Stop retyping the same traveller and booking details across spreadsheets, chats and inboxes.'],
        ['One source of truth', 'Sales, operations and finance work from the same live record for every trip.'],
        ['Get paid faster', 'Send a payment link the moment an invoice is issued, and see what is outstanding at a glance.'],
        ['Delight your travellers', 'A branded portal keeps customers informed and reduces the "where is my document?" emails.'],
    ];

    $steps = [
        ['Request a demo', 'Tell us about your agency using the short form below.'],
        ['We set you up', 'We reply personally and arrange demo access for you.'],
        ['Explore with your team', 'Try bookings, customers, invoices and the traveller portal.'],
    ];

    $destinations = ['Bali', 'Santorini', 'Kyoto', 'Maldives', 'Swiss Alps', 'Dubai', 'Patagonia', 'Cape Town', 'Lisbon', 'Machu Picchu', 'Iceland', 'Marrakech'];
@endphp
<x-site.layout>
    {{-- ============ Hero ============ --}}
    <section class="hero" id="top">
        <div class="hero__sky" aria-hidden="true">
            <span class="cloud cloud--a"></span>
            <span class="cloud cloud--b"></span>
            <span class="cloud cloud--c"></span>
            <svg class="hero__mountains" viewBox="0 0 1440 220" preserveAspectRatio="none" focusable="false">
                <defs>
                    <linearGradient id="mtn-back" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#2a1b6b"/><stop offset="1" stop-color="#0d1030"/></linearGradient>
                    <linearGradient id="mtn-front" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#171346"/><stop offset="1" stop-color="#090b19"/></linearGradient>
                </defs>
                <path fill="url(#mtn-back)" d="M0 150 L140 70 L250 130 L400 40 L560 135 L700 80 L860 150 L1010 60 L1160 140 L1300 85 L1440 150 V220 H0Z"/>
                <path fill="url(#mtn-front)" d="M0 190 L180 120 L320 175 L480 100 L640 180 L800 130 L980 190 L1140 115 L1290 180 L1440 140 V220 H0Z"/>
            </svg>
        </div>

        <div class="container hero__grid">
            <div class="hero__copy">
                <p class="eyebrow reveal"><span class="eyebrow__dot"></span> Built for travel agencies &amp; tour operators</p>
                <h1 class="reveal" style="--d: .06s">Run every trip, booking and traveller from <span class="grad-text">one intelligent CRM</span></h1>
                <p class="lead reveal" style="--d: .12s">{{ config('branding.name') }} brings bookings, customers, invoices, payments and a branded traveller portal together, so your team spends less time on admin and more time selling journeys.</p>
                <div class="hero__cta reveal" style="--d: .18s">
                    <a class="btn btn--primary btn--lg" href="{{ route('demo.create') }}">
                        <span>Request a demo</span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5"/></svg>
                    </a>
                    <a class="btn btn--ghost btn--lg" href="#features">Explore features</a>
                </div>
                <ul class="hero__points reveal" style="--d: .24s">
                    <li>Multi-agency &amp; white-label</li>
                    <li>Customer portal</li>
                    <li>Online payments</li>
                </ul>
            </div>

            <div class="hero__art reveal" style="--d: .1s">
                <svg class="globe" viewBox="0 0 560 560" role="img" aria-label="Illustration: a globe with flight routes connecting travel destinations">
                    <defs>
                        <linearGradient id="g-brand" x1="0" y1="0" x2="1" y2="1">
                            <stop offset="0" stop-color="#08c7fd"/><stop offset=".5" stop-color="#3b5bff"/><stop offset="1" stop-color="#bf42fa"/>
                        </linearGradient>
                        <radialGradient id="g-globe" cx=".34" cy=".28" r=".95">
                            <stop offset="0" stop-color="#27399a"/><stop offset=".55" stop-color="#101646"/><stop offset="1" stop-color="#080a1e"/>
                        </radialGradient>
                        <radialGradient id="g-halo" cx=".5" cy=".5" r=".5">
                            <stop offset=".6" stop-color="#7c3aed" stop-opacity=".35"/><stop offset="1" stop-color="#7c3aed" stop-opacity="0"/>
                        </radialGradient>
                        <clipPath id="globe-clip"><circle cx="280" cy="280" r="190"/></clipPath>
                    </defs>
                    <circle cx="280" cy="280" r="262" fill="url(#g-halo)"/>
                    <circle cx="280" cy="280" r="190" fill="url(#g-globe)" stroke="url(#g-brand)" stroke-width="1.6"/>
                    <g class="globe__grid" fill="none" stroke="url(#g-brand)" stroke-opacity=".38" stroke-width="1" clip-path="url(#globe-clip)">
                        <ellipse cx="280" cy="280" rx="190" ry="60"/>
                        <ellipse cx="280" cy="280" rx="190" ry="125"/>
                        <ellipse cx="280" cy="280" rx="60" ry="190"/>
                        <ellipse cx="280" cy="280" rx="125" ry="190"/>
                        <path d="M90 280h380M280 90v380"/>
                    </g>
                    <g clip-path="url(#globe-clip)" fill="#0b1b4a" fill-opacity=".75" stroke="#08c7fd" stroke-opacity=".35" stroke-width="1">
                        <path d="M150 190c30-26 78-30 104-6 14 14 4 34-14 42-18 8-24 26-48 24-26-2-52-30-42-60Z"/>
                        <path d="M300 160c34-16 86-8 112 18 20 20 10 48-16 58-24 10-30 36-60 30-30-8-62-40-56-74 2-14 8-24 20-32Z"/>
                        <path d="M220 340c26-12 62 0 74 24 12 22-2 54-26 66-24 10-50-6-62-30-8-18-4-48 14-60Z"/>
                        <path d="M368 330c22-8 52 8 58 30 6 22-12 44-34 46-22 2-40-18-38-40 0-14 4-30 14-36Z"/>
                    </g>

                    <path id="route-a" class="route" d="M140 350C170 150 360 110 430 232" fill="none" stroke="url(#g-brand)" stroke-width="2.4" stroke-linecap="round" stroke-dasharray="6 9"/>
                    <path id="route-b" class="route route--b" d="M430 232C470 330 360 420 224 400" fill="none" stroke="#08c7fd" stroke-opacity=".75" stroke-width="2" stroke-linecap="round" stroke-dasharray="4 8"/>

                    <g class="pin"><circle class="pin__pulse" cx="140" cy="350" r="9"/><circle cx="140" cy="350" r="5" fill="#08c7fd"/></g>
                    <g class="pin pin--2"><circle class="pin__pulse" cx="430" cy="232" r="9"/><circle cx="430" cy="232" r="5" fill="#bf42fa"/></g>
                    <g class="pin pin--3"><circle class="pin__pulse" cx="224" cy="400" r="9"/><circle cx="224" cy="400" r="5" fill="#3b5bff"/></g>

                    <g class="plane" aria-hidden="true">
                        <g transform="rotate(90)"><path d="M0-15 5-3l16 6v5L5 5l-2 12 6 4v3L0 22l-9 2v-3l6-4-2-12-16 2v-5L-5-3Z" fill="#fff"/></g>
                        <animateMotion dur="9s" repeatCount="indefinite" rotate="auto"><mpath href="#route-a"/></animateMotion>
                    </g>
                    <g class="plane plane--2" aria-hidden="true">
                        <g transform="rotate(90) scale(.8)"><path d="M0-15 5-3l16 6v5L5 5l-2 12 6 4v3L0 22l-9 2v-3l6-4-2-12-16 2v-5L-5-3Z" fill="#a5f3fc"/></g>
                        <animateMotion dur="11s" begin="2s" repeatCount="indefinite" rotate="auto"><mpath href="#route-b"/></animateMotion>
                    </g>
                </svg>

                <div class="float-card float-card--a" aria-hidden="true">
                    <span class="float-card__dot float-card__dot--ok"></span>
                    <div><strong>Booking confirmed</strong><small>Group departure · seats held</small></div>
                </div>
                <div class="float-card float-card--b" aria-hidden="true">
                    <span class="float-card__dot float-card__dot--pay"></span>
                    <div><strong>Payment received</strong><small>Invoice marked as paid</small></div>
                </div>
                <div class="float-card float-card--c" aria-hidden="true">
                    <span class="float-card__dot float-card__dot--doc"></span>
                    <div><strong>Documents ready</strong><small>Passports &amp; visas collected</small></div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============ Destination ribbon ============ --}}
    <section class="ribbon" aria-label="Destinations your agency sells">
        <div class="ribbon__track" aria-hidden="true">
            @foreach (array_merge($destinations, $destinations) as $place)
                <span>{{ $place }}</span>
            @endforeach
        </div>
        <p class="sr-only">Plan trips to destinations such as {{ implode(', ', $destinations) }}.</p>
    </section>

    {{-- ============ Features ============ --}}
    <section class="section" id="features">
        <div class="container">
            <div class="section__head reveal">
                <p class="eyebrow">Features</p>
                <h2>Everything a travel agency runs on, in one place</h2>
                <p class="lead">From the first enquiry to the final payment, every step lives in the same workspace.</p>
            </div>

            <div class="feature-grid">
                @foreach ($features as $i => [$title, $text, $icon])
                    <article class="feature reveal" style="--d: {{ ($i % 4) * 0.06 }}s">
                        <span class="feature__icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $icon }}"/></svg>
                        </span>
                        <h3>{{ $title }}</h3>
                        <p>{{ $text }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============ How it works ============ --}}
    <section class="section section--alt" id="how-it-works">
        <div class="container">
            <div class="section__head reveal">
                <p class="eyebrow">How it works</p>
                <h2>From first hello to first booking</h2>
            </div>
            <ol class="steps">
                @foreach ($steps as $i => [$title, $text])
                    <li class="step reveal" style="--d: {{ $i * 0.08 }}s">
                        <span class="step__num">{{ $i + 1 }}</span>
                        <h3>{{ $title }}</h3>
                        <p>{{ $text }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    {{-- ============ Benefits ============ --}}
    <section class="section" id="benefits">
        <div class="container benefits">
            <div class="benefits__intro reveal">
                <p class="eyebrow">Benefits</p>
                <h2>More time for travellers, less time on admin</h2>
                <p class="lead">{{ config('branding.name') }} is designed around how agencies really work, so the whole team stays in sync.</p>
                <a class="btn btn--primary" href="{{ route('demo.create') }}">Request a demo</a>
            </div>
            <div class="benefits__list">
                @foreach ($benefits as $i => [$title, $text])
                    <div class="benefit reveal" style="--d: {{ $i * 0.07 }}s">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                        <div>
                            <h3>{{ $title }}</h3>
                            <p>{{ $text }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============ Demo call to action ============ --}}
    <section class="section section--cta" id="demo">
        <div class="container cta">
            <div class="cta__copy reveal">
                <p class="eyebrow">Get demo access</p>
                <h2>Ready to see it with your own trips in mind?</h2>
                <p class="lead">Request a demo and we will show you how {{ config('branding.name') }} can fit your agency.</p>
                <ul class="cta__list">
                    <li>Personal reply, no automatic sign-up</li>
                    <li>Walk through bookings, customers and invoices</li>
                    <li>See the branded traveller portal</li>
                </ul>
            </div>
            <div class="card card--form reveal" style="--d: .08s">
                @include('site.partials.demo-form')
            </div>
        </div>
    </section>
</x-site.layout>
