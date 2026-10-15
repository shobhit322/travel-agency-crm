<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>VI Studio Travel CRM — Manage Your Travel Agency Smarter</title>
        <meta name="description" content="VI Studio Travel CRM is a premium travel agency management platform. Streamline bookings, manage clients, automate invoicing, and grow your travel business with our all-in-one CRM solution.">
        <meta name="keywords" content="travel CRM, travel agency management, booking management, client management, invoicing, VI Studio">

        <!-- Favicon -->
        <link rel="icon" type="image/jpeg" href="{{ asset('vi-studio-favicon.jpg') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif

        <style>
            *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
            
            :root {
                --vi-purple: #7c3aed;
                --vi-purple-light: #a78bfa;
                --vi-cyan: #06b6d4;
                --vi-cyan-light: #22d3ee;
                --vi-neon-blue: #00d4ff;
                --vi-dark: #0a0a1a;
                --vi-dark-card: #0f0f23;
                --vi-dark-surface: #1a1a2e;
                --vi-text: #e0e7ff;
                --vi-text-muted: #a5b4fc;
                --vi-gradient: linear-gradient(135deg, var(--vi-purple), var(--vi-cyan));
                --vi-gradient-soft: linear-gradient(135deg, rgba(124,58,237,0.15), rgba(6,182,212,0.1));
            }

            html { scroll-behavior: smooth; }

            body {
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
                background: var(--vi-dark);
                color: var(--vi-text);
                overflow-x: hidden;
                line-height: 1.6;
            }

            /* ===== ANIMATED BACKGROUND ===== */
            .hero-bg {
                position: fixed;
                top: 0; left: 0; right: 0; bottom: 0;
                z-index: 0;
                background:
                    radial-gradient(ellipse at 20% 50%, rgba(124,58,237,0.12) 0%, transparent 50%),
                    radial-gradient(ellipse at 80% 20%, rgba(0,212,255,0.08) 0%, transparent 50%),
                    radial-gradient(ellipse at 50% 80%, rgba(6,182,212,0.06) 0%, transparent 50%),
                    var(--vi-dark);
                animation: bg-shift 25s ease-in-out infinite;
            }

            @keyframes bg-shift {
                0%, 100% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
            }

            /* Floating orbs */
            .orb {
                position: absolute;
                border-radius: 50%;
                filter: blur(80px);
                pointer-events: none;
                animation: float 20s ease-in-out infinite;
            }
            .orb-1 { width: 400px; height: 400px; background: rgba(124,58,237,0.12); top: 10%; left: -5%; animation-duration: 22s; }
            .orb-2 { width: 300px; height: 300px; background: rgba(6,182,212,0.1); top: 60%; right: -5%; animation-duration: 18s; animation-delay: -5s; }
            .orb-3 { width: 250px; height: 250px; background: rgba(0,212,255,0.08); top: 30%; right: 20%; animation-duration: 24s; animation-delay: -10s; }

            @keyframes float {
                0%, 100% { transform: translate(0, 0); }
                25% { transform: translate(30px, -30px); }
                50% { transform: translate(-20px, 20px); }
                75% { transform: translate(20px, -10px); }
            }

            /* ===== NAVBAR ===== */
            .navbar {
                position: fixed;
                top: 0; left: 0; right: 0;
                z-index: 1000;
                padding: 1rem 2rem;
                display: flex;
                align-items: center;
                justify-content: space-between;
                background: rgba(10,10,26,0.85);
                backdrop-filter: blur(20px) saturate(180%);
                border-bottom: 1px solid rgba(124,58,237,0.1);
                transition: all 0.3s ease;
            }

            .navbar.scrolled {
                padding: 0.75rem 2rem;
                background: rgba(10,10,26,0.95);
                box-shadow: 0 4px 30px rgba(0,0,0,0.3);
            }

            .nav-brand {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                text-decoration: none;
            }

            .nav-logo {
                height: 2.5rem;
                width: auto;
                filter: drop-shadow(0 0 8px rgba(124,58,237,0.4));
                transition: filter 0.3s ease;
            }

            .nav-logo:hover {
                filter: drop-shadow(0 0 16px rgba(0,212,255,0.6));
            }

            .nav-title {
                font-size: 1.25rem;
                font-weight: 700;
                background: var(--vi-gradient);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .nav-links {
                display: flex;
                align-items: center;
                gap: 1.5rem;
                list-style: none;
            }

            .nav-links a {
                color: var(--vi-text-muted);
                text-decoration: none;
                font-size: 0.9rem;
                font-weight: 500;
                transition: color 0.2s ease;
                position: relative;
            }

            .nav-links a:hover {
                color: var(--vi-text);
            }

            .nav-links a::after {
                content: '';
                position: absolute;
                bottom: -4px;
                left: 0;
                width: 0;
                height: 2px;
                background: var(--vi-gradient);
                transition: width 0.3s ease;
            }

            .nav-links a:hover::after {
                width: 100%;
            }

            .btn {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                padding: 0.7rem 1.5rem;
                border-radius: 0.75rem;
                font-weight: 600;
                font-size: 0.9rem;
                text-decoration: none;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                cursor: pointer;
                border: none;
                font-family: inherit;
            }

            .btn-primary {
                background: var(--vi-gradient);
                color: white;
                box-shadow: 0 4px 15px rgba(124,58,237,0.3);
            }

            .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 30px rgba(124,58,237,0.4);
            }

            .btn-secondary {
                background: rgba(124,58,237,0.1);
                color: var(--vi-purple-light);
                border: 1px solid rgba(124,58,237,0.2);
            }

            .btn-secondary:hover {
                background: rgba(124,58,237,0.2);
                border-color: rgba(124,58,237,0.4);
                transform: translateY(-2px);
            }

            .btn-ghost {
                background: transparent;
                color: var(--vi-text-muted);
                border: 1px solid rgba(165,180,252,0.2);
            }

            .btn-ghost:hover {
                border-color: var(--vi-purple-light);
                color: var(--vi-text);
                background: rgba(124,58,237,0.06);
            }

            /* ===== HERO SECTION ===== */
            .hero {
                position: relative;
                z-index: 1;
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 8rem 2rem 4rem;
                text-align: center;
            }

            .hero-content {
                max-width: 800px;
                animation: fadeInUp 0.8s ease-out;
            }

            .hero-badge {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                padding: 0.4rem 1rem;
                background: rgba(124,58,237,0.12);
                border: 1px solid rgba(124,58,237,0.2);
                border-radius: 9999px;
                font-size: 0.8rem;
                font-weight: 500;
                color: var(--vi-purple-light);
                margin-bottom: 2rem;
            }

            .hero-badge-dot {
                width: 6px;
                height: 6px;
                border-radius: 50%;
                background: var(--vi-cyan);
                animation: pulse 2s infinite;
            }

            @keyframes pulse {
                0%, 100% { opacity: 1; }
                50% { opacity: 0.5; }
            }

            .hero h1 {
                font-size: clamp(2.5rem, 6vw, 4rem);
                font-weight: 800;
                line-height: 1.1;
                margin-bottom: 1.5rem;
                letter-spacing: -0.03em;
            }

            .hero h1 .gradient-text {
                background: var(--vi-gradient);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .hero p {
                font-size: 1.15rem;
                color: var(--vi-text-muted);
                margin-bottom: 2.5rem;
                max-width: 600px;
                margin-left: auto;
                margin-right: auto;
                line-height: 1.7;
            }

            .hero-actions {
                display: flex;
                gap: 1rem;
                justify-content: center;
                flex-wrap: wrap;
            }

            .hero-stats {
                display: flex;
                justify-content: center;
                gap: 3rem;
                margin-top: 4rem;
                padding-top: 2rem;
                border-top: 1px solid rgba(124,58,237,0.1);
            }

            .stat-item {
                text-align: center;
            }

            .stat-number {
                font-size: 2rem;
                font-weight: 800;
                background: var(--vi-gradient);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .stat-label {
                font-size: 0.8rem;
                color: var(--vi-text-muted);
                margin-top: 0.25rem;
            }

            /* ===== SECTIONS ===== */
            section {
                position: relative;
                z-index: 1;
                padding: 6rem 2rem;
            }

            .container {
                max-width: 1200px;
                margin: 0 auto;
            }

            .section-header {
                text-align: center;
                margin-bottom: 4rem;
            }

            .section-header h2 {
                font-size: clamp(1.8rem, 4vw, 2.5rem);
                font-weight: 700;
                margin-bottom: 1rem;
                letter-spacing: -0.02em;
            }

            .section-header p {
                font-size: 1.05rem;
                color: var(--vi-text-muted);
                max-width: 600px;
                margin: 0 auto;
            }

            /* ===== FEATURES GRID ===== */
            .features-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
                gap: 1.5rem;
            }

            .feature-card {
                background: rgba(15,15,35,0.6);
                backdrop-filter: blur(12px);
                border: 1px solid rgba(124,58,237,0.1);
                border-radius: 1.25rem;
                padding: 2rem;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                position: relative;
                overflow: hidden;
            }

            .feature-card::before {
                content: '';
                position: absolute;
                top: 0; left: 0;
                width: 100%; height: 3px;
                background: var(--vi-gradient);
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .feature-card:hover {
                border-color: rgba(124,58,237,0.25);
                transform: translateY(-4px);
                box-shadow: 0 12px 40px rgba(124,58,237,0.12);
            }

            .feature-card:hover::before {
                opacity: 1;
            }

            .feature-icon {
                width: 3rem;
                height: 3rem;
                border-radius: 0.75rem;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 1.25rem;
                font-size: 1.5rem;
                background: var(--vi-gradient-soft);
            }

            .feature-card h3 {
                font-size: 1.15rem;
                font-weight: 600;
                margin-bottom: 0.75rem;
            }

            .feature-card p {
                font-size: 0.9rem;
                color: var(--vi-text-muted);
                line-height: 1.6;
            }

            /* ===== BENEFITS SECTION ===== */
            .benefits {
                background: linear-gradient(180deg, transparent, rgba(124,58,237,0.03), transparent);
            }

            .benefits-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 2rem;
            }

            .benefit-item {
                display: flex;
                gap: 1rem;
                align-items: flex-start;
                padding: 1.5rem;
                border-radius: 1rem;
                transition: all 0.3s ease;
            }

            .benefit-item:hover {
                background: rgba(124,58,237,0.06);
            }

            .benefit-check {
                flex-shrink: 0;
                width: 2rem;
                height: 2rem;
                border-radius: 50%;
                background: var(--vi-gradient-soft);
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--vi-cyan);
                font-size: 1rem;
            }

            .benefit-item h4 {
                font-size: 1rem;
                font-weight: 600;
                margin-bottom: 0.25rem;
            }

            .benefit-item p {
                font-size: 0.85rem;
                color: var(--vi-text-muted);
            }

            /* ===== CTA SECTION ===== */
            .cta-section {
                text-align: center;
                padding: 6rem 2rem;
            }

            .cta-card {
                max-width: 700px;
                margin: 0 auto;
                background: rgba(15,15,35,0.7);
                backdrop-filter: blur(20px);
                border: 1px solid rgba(124,58,237,0.15);
                border-radius: 2rem;
                padding: 4rem 3rem;
                position: relative;
                overflow: hidden;
            }

            .cta-card::before {
                content: '';
                position: absolute;
                top: -2px; left: -2px; right: -2px; bottom: -2px;
                background: var(--vi-gradient);
                border-radius: 2rem;
                z-index: -1;
                opacity: 0.15;
            }

            .cta-card h2 {
                font-size: 2rem;
                font-weight: 700;
                margin-bottom: 1rem;
            }

            .cta-card p {
                color: var(--vi-text-muted);
                margin-bottom: 2rem;
                font-size: 1.05rem;
            }

            /* ===== FOOTER ===== */
            .footer {
                position: relative;
                z-index: 1;
                border-top: 1px solid rgba(124,58,237,0.1);
                padding: 3rem 2rem;
            }

            .footer-content {
                max-width: 1200px;
                margin: 0 auto;
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                align-items: center;
                gap: 1.5rem;
            }

            .footer-brand {
                display: flex;
                align-items: center;
                gap: 0.75rem;
            }

            .footer-logo {
                height: 2rem;
                filter: drop-shadow(0 0 6px rgba(124,58,237,0.3));
            }

            .footer-name {
                font-weight: 600;
                font-size: 0.95rem;
                color: var(--vi-text-muted);
            }

            .footer-links {
                display: flex;
                gap: 2rem;
                list-style: none;
            }

            .footer-links a {
                color: var(--vi-text-muted);
                text-decoration: none;
                font-size: 0.85rem;
                transition: color 0.2s ease;
            }

            .footer-links a:hover {
                color: var(--vi-purple-light);
            }

            .footer-copy {
                color: rgba(165,180,252,0.4);
                font-size: 0.8rem;
                width: 100%;
                text-align: center;
                margin-top: 1.5rem;
                padding-top: 1.5rem;
                border-top: 1px solid rgba(124,58,237,0.06);
            }

            /* ===== DEMO MODAL ===== */
            .modal-overlay {
                display: none;
                position: fixed;
                top: 0; left: 0; right: 0; bottom: 0;
                background: rgba(0,0,0,0.6);
                backdrop-filter: blur(8px);
                z-index: 2000;
                align-items: center;
                justify-content: center;
                padding: 1rem;
                animation: fadeIn 0.2s ease;
            }

            .modal-overlay.active {
                display: flex;
            }

            .modal {
                background: var(--vi-dark-card);
                border: 1px solid rgba(124,58,237,0.2);
                border-radius: 1.5rem;
                padding: 2.5rem;
                width: 100%;
                max-width: 480px;
                position: relative;
                box-shadow: 0 25px 60px rgba(0,0,0,0.5), 0 0 40px rgba(124,58,237,0.1);
                animation: slideUp 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }

            @keyframes slideUp {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }

            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }

            .modal-close {
                position: absolute;
                top: 1rem; right: 1rem;
                background: rgba(124,58,237,0.1);
                border: 1px solid rgba(124,58,237,0.15);
                border-radius: 0.5rem;
                width: 2rem; height: 2rem;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                color: var(--vi-text-muted);
                font-size: 1.1rem;
                transition: all 0.2s ease;
            }

            .modal-close:hover {
                background: rgba(124,58,237,0.2);
                color: var(--vi-text);
            }

            .modal h2 {
                font-size: 1.5rem;
                font-weight: 700;
                margin-bottom: 0.5rem;
            }

            .modal .modal-desc {
                color: var(--vi-text-muted);
                font-size: 0.9rem;
                margin-bottom: 2rem;
            }

            .form-group {
                margin-bottom: 1.25rem;
            }

            .form-group label {
                display: block;
                font-size: 0.85rem;
                font-weight: 500;
                color: var(--vi-purple-light);
                margin-bottom: 0.4rem;
            }

            .form-group input,
            .form-group textarea {
                width: 100%;
                padding: 0.75rem 1rem;
                background: rgba(124,58,237,0.06);
                border: 1px solid rgba(124,58,237,0.15);
                border-radius: 0.75rem;
                color: var(--vi-text);
                font-family: inherit;
                font-size: 0.9rem;
                outline: none;
                transition: all 0.2s ease;
            }

            .form-group input:focus,
            .form-group textarea:focus {
                border-color: var(--vi-purple);
                box-shadow: 0 0 0 3px rgba(124,58,237,0.15);
            }

            .form-group input::placeholder,
            .form-group textarea::placeholder {
                color: rgba(165,180,252,0.35);
            }

            .form-group textarea {
                resize: vertical;
                min-height: 80px;
            }

            .form-error {
                color: #f87171;
                font-size: 0.8rem;
                margin-top: 0.25rem;
                display: none;
            }

            .form-error.visible {
                display: block;
            }

            .form-success {
                background: rgba(6,182,212,0.1);
                border: 1px solid rgba(6,182,212,0.2);
                border-radius: 0.75rem;
                padding: 1rem;
                color: var(--vi-cyan-light);
                font-size: 0.9rem;
                text-align: center;
                display: none;
            }

            .form-success.visible {
                display: block;
            }

            .btn-submit {
                width: 100%;
                padding: 0.85rem;
                font-size: 1rem;
            }

            .btn-submit:disabled {
                opacity: 0.6;
                cursor: not-allowed;
                transform: none !important;
            }

            /* ===== SCROLL REVEAL ===== */
            .reveal {
                opacity: 0;
                transform: translateY(30px);
                transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .reveal.visible {
                opacity: 1;
                transform: translateY(0);
            }

            /* ===== RESPONSIVE ===== */
            .mobile-menu-btn {
                display: none;
                background: none;
                border: 1px solid rgba(124,58,237,0.2);
                border-radius: 0.5rem;
                padding: 0.5rem;
                color: var(--vi-text-muted);
                cursor: pointer;
                font-size: 1.25rem;
            }

            @media (max-width: 768px) {
                .nav-links {
                    display: none;
                    position: absolute;
                    top: 100%; left: 0; right: 0;
                    flex-direction: column;
                    background: rgba(10,10,26,0.98);
                    backdrop-filter: blur(20px);
                    padding: 1.5rem;
                    border-bottom: 1px solid rgba(124,58,237,0.1);
                    gap: 1rem;
                }

                .nav-links.open {
                    display: flex;
                }

                .mobile-menu-btn {
                    display: block;
                }

                .hero-stats {
                    gap: 1.5rem;
                    flex-wrap: wrap;
                }

                .stat-number {
                    font-size: 1.5rem;
                }

                .features-grid {
                    grid-template-columns: 1fr;
                }

                .benefits-grid {
                    grid-template-columns: 1fr;
                }

                .cta-card {
                    padding: 2.5rem 1.5rem;
                }

                .footer-content {
                    flex-direction: column;
                    text-align: center;
                }

                .footer-links {
                    flex-wrap: wrap;
                    justify-content: center;
                }
            }

            @keyframes fadeInUp {
                from { opacity: 0; transform: translateY(30px); }
                to { opacity: 1; transform: translateY(0); }
            }
        </style>
    </head>
    <body>
        <!-- Background effects -->
        <div class="hero-bg">
            <div class="orb orb-1"></div>
            <div class="orb orb-2"></div>
            <div class="orb orb-3"></div>
        </div>

        <!-- Navigation -->
        <nav class="navbar" id="navbar">
            <a href="/" class="nav-brand">
                <img src="{{ asset('vi-studio-logo.png') }}" alt="VI Studio Travel CRM" class="nav-logo">
                <span class="nav-title">VI Studio Travel CRM</span>
            </a>
            <button class="mobile-menu-btn" id="mobile-menu-btn" aria-label="Toggle navigation">☰</button>
            <ul class="nav-links" id="nav-links">
                <li><a href="#features">Features</a></li>
                <li><a href="#benefits">Why Us</a></li>
                <li><a href="#cta">Get Started</a></li>
                <li><a href="{{ url('/admin/login') }}" class="btn btn-ghost">Sign In</a></li>
                <li><a href="#" class="btn btn-primary" id="nav-demo-btn">Request Demo</a></li>
            </ul>
        </nav>

        <!-- Hero Section -->
        <section class="hero" id="hero">
            <div class="hero-content">
                <div class="hero-badge">
                    <span class="hero-badge-dot"></span>
                    All-in-One Travel Management Platform
                </div>
                <h1>
                    Manage Your Travel Agency<br>
                    <span class="gradient-text">Smarter & Faster</span>
                </h1>
                <p>
                    Streamline bookings, delight clients, and grow your revenue with VI Studio Travel CRM
                    — the modern platform built for ambitious travel agencies.
                </p>
                <div class="hero-actions">
                    <a href="#" class="btn btn-primary" id="hero-demo-btn">
                        ✨ Request a Demo
                    </a>
                    <a href="#features" class="btn btn-secondary">
                        Explore Features →
                    </a>
                </div>
                <div class="hero-stats">
                    <div class="stat-item">
                        <div class="stat-number">500+</div>
                        <div class="stat-label">Travel Agencies</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">50K+</div>
                        <div class="stat-label">Bookings Managed</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">99.9%</div>
                        <div class="stat-label">Uptime</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">24/7</div>
                        <div class="stat-label">Support</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features">
            <div class="container">
                <div class="section-header reveal">
                    <h2>Everything Your Travel Agency Needs</h2>
                    <p>A complete suite of tools designed to transform how you manage your travel business.</p>
                </div>
                <div class="features-grid">
                    <div class="feature-card reveal">
                        <div class="feature-icon">🎫</div>
                        <h3>Smart Booking Management</h3>
                        <p>Manage all your bookings in one place. From inquiries to confirmations, track every step of the customer journey with automated workflows.</p>
                    </div>
                    <div class="feature-card reveal">
                        <div class="feature-icon">👥</div>
                        <h3>Client Relationship Hub</h3>
                        <p>Build lasting relationships with a powerful CRM. Store customer preferences, travel history, and communication logs to personalize every interaction.</p>
                    </div>
                    <div class="feature-card reveal">
                        <div class="feature-icon">💳</div>
                        <h3>Invoicing & Payments</h3>
                        <p>Generate professional invoices, track payments, and automate reminders. Support multiple currencies and payment gateways out of the box.</p>
                    </div>
                    <div class="feature-card reveal">
                        <div class="feature-icon">📦</div>
                        <h3>Package Builder</h3>
                        <p>Create stunning travel packages with included services, itineraries, and dynamic pricing. Showcase them on your branded booking pages.</p>
                    </div>
                    <div class="feature-card reveal">
                        <div class="feature-icon">📊</div>
                        <h3>Analytics & Reports</h3>
                        <p>Get actionable insights with real-time dashboards. Track revenue, booking trends, team performance, and customer acquisition metrics.</p>
                    </div>
                    <div class="feature-card reveal">
                        <div class="feature-icon">✉️</div>
                        <h3>Email Campaigns</h3>
                        <p>Send personalized email campaigns to your clients. Promote new packages, share travel tips, and keep your audience engaged.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Benefits Section -->
        <section class="benefits" id="benefits">
            <div class="container">
                <div class="section-header reveal">
                    <h2>Why Travel Agencies Choose VI Studio</h2>
                    <p>Built by travel industry experts for travel professionals who demand the best.</p>
                </div>
                <div class="benefits-grid">
                    <div class="benefit-item reveal">
                        <div class="benefit-check">✓</div>
                        <div>
                            <h4>Multi-Tenant Architecture</h4>
                            <p>Each agency gets their own branded workspace with custom domains, logos, and color schemes.</p>
                        </div>
                    </div>
                    <div class="benefit-item reveal">
                        <div class="benefit-check">✓</div>
                        <div>
                            <h4>Customer Portal</h4>
                            <p>Give your clients a self-service portal to view bookings, pay invoices, and manage their trips.</p>
                        </div>
                    </div>
                    <div class="benefit-item reveal">
                        <div class="benefit-check">✓</div>
                        <div>
                            <h4>Role-Based Access</h4>
                            <p>Fine-grained permissions for your team. Admins, managers, and agents each see exactly what they need.</p>
                        </div>
                    </div>
                    <div class="benefit-item reveal">
                        <div class="benefit-check">✓</div>
                        <div>
                            <h4>Mobile Responsive</h4>
                            <p>Manage your business on the go. Every feature works perfectly on any screen size.</p>
                        </div>
                    </div>
                    <div class="benefit-item reveal">
                        <div class="benefit-check">✓</div>
                        <div>
                            <h4>Secure & Reliable</h4>
                            <p>Enterprise-grade security with encrypted data, regular backups, and 99.9% uptime guarantee.</p>
                        </div>
                    </div>
                    <div class="benefit-item reveal">
                        <div class="benefit-check">✓</div>
                        <div>
                            <h4>Fixed Departures</h4>
                            <p>Publish group trips with available slots, waitlists, and countdown timers to drive urgency.</p>
                        </div>
                    </div>
                    <div class="benefit-item reveal">
                        <div class="benefit-check">✓</div>
                        <div>
                            <h4>Gift Vouchers</h4>
                            <p>Sell branded gift vouchers online and let customers redeem them against future bookings.</p>
                        </div>
                    </div>
                    <div class="benefit-item reveal">
                        <div class="benefit-check">✓</div>
                        <div>
                            <h4>API Integration</h4>
                            <p>RESTful API for seamless integration with your existing website, booking engine, or CMS.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta-section" id="cta">
            <div class="cta-card reveal">
                <h2>Ready to Transform Your Travel Business?</h2>
                <p>Join hundreds of travel agencies already using VI Studio Travel CRM to streamline operations and delight their clients.</p>
                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <a href="#" class="btn btn-primary" id="cta-demo-btn" style="font-size: 1.05rem; padding: 0.9rem 2rem;">
                        ✨ Request a Demo
                    </a>
                    <a href="{{ url('/admin/login') }}" class="btn btn-ghost" style="font-size: 1.05rem; padding: 0.9rem 2rem;">
                        Sign In →
                    </a>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="footer">
            <div class="footer-content">
                <div class="footer-brand">
                    <img src="{{ asset('vi-studio-logo.png') }}" alt="VI Studio" class="footer-logo">
                    <span class="footer-name">VI Studio Travel CRM</span>
                </div>
                <ul class="footer-links">
                    <li><a href="#features">Features</a></li>
                    <li><a href="#benefits">Benefits</a></li>
                    <li><a href="{{ url('/admin/login') }}">Admin Login</a></li>
                    <li><a href="#" id="footer-demo-btn">Request Demo</a></li>
                </ul>
                <div class="footer-copy">
                    &copy; {{ date('Y') }} VI Studio Travel CRM. Built with Virtual Intelligence. All rights reserved.
                </div>
            </div>
        </footer>

        <!-- Demo Request Modal -->
        <div class="modal-overlay" id="demo-modal">
            <div class="modal">
                <button class="modal-close" id="modal-close" aria-label="Close modal">&times;</button>
                <h2>Request a Demo</h2>
                <p class="modal-desc">Fill in your details and our team will set you up with a personalized demo.</p>

                <div class="form-success" id="form-success">
                    🎉 Thank you! Your demo request has been received. We'll contact you shortly.
                </div>

                <form id="demo-form">
                    <div class="form-group">
                        <label for="demo-name">Full Name *</label>
                        <input type="text" id="demo-name" name="name" placeholder="John Smith" required>
                        <div class="form-error" id="error-name">Please enter your name</div>
                    </div>
                    <div class="form-group">
                        <label for="demo-email">Work Email *</label>
                        <input type="email" id="demo-email" name="email" placeholder="you@travelagency.com" required>
                        <div class="form-error" id="error-email">Please enter a valid email</div>
                    </div>
                    <div class="form-group">
                        <label for="demo-company">Company / Agency</label>
                        <input type="text" id="demo-company" name="company" placeholder="Your Travel Agency">
                    </div>
                    <div class="form-group">
                        <label for="demo-message">Message</label>
                        <textarea id="demo-message" name="message" placeholder="Tell us about your agency and what you're looking for..." rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-submit" id="demo-submit">
                        Send Request
                    </button>
                </form>
            </div>
        </div>

        <script>
            // === Navbar scroll effect ===
            const navbar = document.getElementById('navbar');
            window.addEventListener('scroll', () => {
                navbar.classList.toggle('scrolled', window.scrollY > 50);
            });

            // === Mobile menu ===
            const mobileBtn = document.getElementById('mobile-menu-btn');
            const navLinks = document.getElementById('nav-links');
            mobileBtn.addEventListener('click', () => {
                navLinks.classList.toggle('open');
                mobileBtn.textContent = navLinks.classList.contains('open') ? '✕' : '☰';
            });

            // === Scroll reveal ===
            const reveals = document.querySelectorAll('.reveal');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, i) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => entry.target.classList.add('visible'), i * 100);
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });
            reveals.forEach(el => observer.observe(el));

            // === Demo Modal ===
            const modal = document.getElementById('demo-modal');
            const modalClose = document.getElementById('modal-close');
            const demoForm = document.getElementById('demo-form');
            const formSuccess = document.getElementById('form-success');

            function openModal(e) {
                e.preventDefault();
                modal.classList.add('active');
                document.body.style.overflow = 'hidden';
                formSuccess.classList.remove('visible');
                demoForm.style.display = 'block';
                demoForm.reset();
                document.querySelectorAll('.form-error').forEach(el => el.classList.remove('visible'));
            }

            function closeModal() {
                modal.classList.remove('active');
                document.body.style.overflow = '';
            }

            // Attach modal open to all demo buttons
            ['nav-demo-btn', 'hero-demo-btn', 'cta-demo-btn', 'footer-demo-btn'].forEach(id => {
                const el = document.getElementById(id);
                if (el) el.addEventListener('click', openModal);
            });

            modalClose.addEventListener('click', closeModal);
            modal.addEventListener('click', (e) => {
                if (e.target === modal) closeModal();
            });
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && modal.classList.contains('active')) closeModal();
            });

            // === Form submission ===
            demoForm.addEventListener('submit', async (e) => {
                e.preventDefault();

                // Reset errors
                document.querySelectorAll('.form-error').forEach(el => el.classList.remove('visible'));

                const name = document.getElementById('demo-name').value.trim();
                const email = document.getElementById('demo-email').value.trim();
                const company = document.getElementById('demo-company').value.trim();
                const message = document.getElementById('demo-message').value.trim();

                // Client-side validation
                let hasError = false;
                if (!name) {
                    document.getElementById('error-name').classList.add('visible');
                    hasError = true;
                }
                if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                    document.getElementById('error-email').classList.add('visible');
                    hasError = true;
                }
                if (hasError) return;

                const submitBtn = document.getElementById('demo-submit');
                submitBtn.disabled = true;
                submitBtn.textContent = 'Sending...';

                try {
                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const response = await fetch('{{ route("demo-request.store") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': token,
                        },
                        body: JSON.stringify({ name, email, company, message, _token: token }),
                    });

                    const data = await response.json();

                    if (response.ok && data.success) {
                        demoForm.style.display = 'none';
                        formSuccess.classList.add('visible');
                    } else {
                        // Show server validation errors
                        if (data.errors) {
                            Object.keys(data.errors).forEach(field => {
                                const errorEl = document.getElementById('error-' + field);
                                if (errorEl) {
                                    errorEl.textContent = data.errors[field][0];
                                    errorEl.classList.add('visible');
                                }
                            });
                        } else if (data.message) {
                            alert(data.message);
                        }
                    }
                } catch (err) {
                    alert('Something went wrong. Please try again later.');
                } finally {
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Send Request';
                }
            });
        </script>
    </body>
</html>
