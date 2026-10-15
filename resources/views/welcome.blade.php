<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>VI Studio Travel CRM — Manage Your Travel Agency Smarter</title>
        <meta name="description" content="VI Studio Travel CRM is a premium travel agency management platform. Streamline bookings, manage clients, automate invoicing, and scale your travel business with our all-in-one CRM solution.">
        <meta name="keywords" content="travel CRM, travel agency management, tour operator software, booking management, itinerary builder, invoicing, VI Studio">

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
                --vi-border: rgba(124, 58, 237, 0.2);
                --vi-gradient: linear-gradient(135deg, var(--vi-purple), var(--vi-cyan));
                --vi-gradient-hover: linear-gradient(135deg, #8b5cf6, #00d4ff);
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
                    radial-gradient(ellipse at 20% 50%, rgba(124,58,237,0.14) 0%, transparent 50%),
                    radial-gradient(ellipse at 80% 20%, rgba(0,212,255,0.1) 0%, transparent 50%),
                    radial-gradient(ellipse at 50% 80%, rgba(6,182,212,0.08) 0%, transparent 50%),
                    var(--vi-dark);
                pointer-events: none;
            }

            .orb {
                position: absolute;
                border-radius: 50%;
                filter: blur(90px);
                pointer-events: none;
                animation: float 22s ease-in-out infinite;
            }
            .orb-1 { width: 450px; height: 450px; background: rgba(124,58,237,0.15); top: 5%; left: -8%; }
            .orb-2 { width: 350px; height: 350px; background: rgba(6,182,212,0.12); top: 55%; right: -5%; animation-delay: -6s; }
            .orb-3 { width: 300px; height: 300px; background: rgba(0,212,255,0.1); top: 25%; right: 25%; animation-delay: -12s; }

            @keyframes float {
                0%, 100% { transform: translate(0, 0); }
                25% { transform: translate(30px, -25px); }
                50% { transform: translate(-25px, 20px); }
                75% { transform: translate(20px, -15px); }
            }

            /* ===== NAVBAR ===== */
            .navbar {
                position: fixed;
                top: 0; left: 0; right: 0;
                z-index: 1000;
                padding: 1.1rem 2.5rem;
                display: flex;
                align-items: center;
                justify-content: space-between;
                background: rgba(10,10,26,0.85);
                backdrop-filter: blur(20px) saturate(180%);
                border-bottom: 1px solid var(--vi-border);
                transition: all 0.3s ease;
            }

            .navbar.scrolled {
                padding: 0.85rem 2.5rem;
                background: rgba(10,10,26,0.96);
                box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            }

            .nav-brand {
                display: flex;
                align-items: center;
                gap: 0.85rem;
                text-decoration: none;
            }

            .nav-logo {
                height: 2.75rem;
                width: auto;
                max-width: 180px;
                object-fit: contain;
                filter: drop-shadow(0 0 10px rgba(124,58,237,0.4));
                transition: transform 0.3s ease, filter 0.3s ease;
            }

            .nav-brand:hover .nav-logo {
                transform: scale(1.03);
                filter: drop-shadow(0 0 15px rgba(0,212,255,0.6));
            }

            .nav-title {
                font-size: 1.15rem;
                font-weight: 700;
                color: #ffffff;
                letter-spacing: -0.01em;
            }

            .nav-links {
                display: flex;
                align-items: center;
                gap: 2rem;
                list-style: none;
            }

            .nav-links a {
                color: var(--vi-text-muted);
                text-decoration: none;
                font-size: 0.9rem;
                font-weight: 500;
                transition: color 0.25s ease;
                position: relative;
            }

            .nav-links a:hover {
                color: #ffffff;
            }

            .nav-links a.nav-item-link::after {
                content: '';
                position: absolute;
                bottom: -4px;
                left: 0;
                width: 0;
                height: 2px;
                background: var(--vi-gradient);
                transition: width 0.3s ease;
            }

            .nav-links a.nav-item-link:hover::after {
                width: 100%;
            }

            .btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 0.5rem;
                padding: 0.7rem 1.4rem;
                border-radius: 0.75rem;
                font-weight: 600;
                font-size: 0.875rem;
                text-decoration: none;
                transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
                cursor: pointer;
                border: none;
                font-family: inherit;
                line-height: 1;
            }

            .btn-primary {
                background: var(--vi-gradient);
                color: white;
                box-shadow: 0 4px 15px rgba(124,58,237,0.35);
                border: 1px solid rgba(255,255,255,0.15);
            }

            .btn-primary:hover {
                background: var(--vi-gradient-hover);
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(124,58,237,0.5), 0 0 15px rgba(0,212,255,0.3);
            }

            .btn-secondary {
                background: rgba(124,58,237,0.12);
                color: var(--vi-text);
                border: 1px solid rgba(124,58,237,0.3);
            }

            .btn-secondary:hover {
                background: rgba(124,58,237,0.22);
                border-color: rgba(0,212,255,0.4);
                transform: translateY(-2px);
                color: #ffffff;
            }

            .btn-ghost {
                background: transparent;
                color: var(--vi-text-muted);
                border: 1px solid rgba(165,180,252,0.2);
            }

            .btn-ghost:hover {
                border-color: var(--vi-purple-light);
                color: #ffffff;
                background: rgba(124,58,237,0.1);
            }

            .mobile-menu-btn {
                display: none;
                background: none;
                border: none;
                color: var(--vi-text);
                font-size: 1.5rem;
                cursor: pointer;
            }

            /* ===== HERO SECTION ===== */
            .hero {
                position: relative;
                z-index: 1;
                min-height: 100vh;
                display: flex;
                align-items: center;
                padding: 7.5rem 2.5rem 4rem;
            }

            .hero-container {
                max-width: 1240px;
                margin: 0 auto;
                display: grid;
                grid-template-columns: 1.1fr 0.9fr;
                gap: 3.5rem;
                align-items: center;
                width: 100%;
            }

            .hero-badge {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                padding: 0.4rem 1rem;
                background: rgba(124,58,237,0.16);
                border: 1px solid rgba(124,58,237,0.35);
                border-radius: 9999px;
                font-size: 0.775rem;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                color: #00d4ff;
                margin-bottom: 1.5rem;
            }

            .hero-badge-dot {
                width: 6px;
                height: 6px;
                border-radius: 50%;
                background: #00d4ff;
                box-shadow: 0 0 8px #00d4ff;
                animation: pulse 2s infinite;
            }

            @keyframes pulse {
                0%, 100% { opacity: 1; }
                50% { opacity: 0.4; }
            }

            .hero h1 {
                font-size: clamp(2.3rem, 4.5vw, 3.6rem);
                font-weight: 800;
                line-height: 1.15;
                margin-bottom: 1.25rem;
                letter-spacing: -0.025em;
                color: #ffffff;
            }

            .hero h1 .gradient-text {
                background: var(--vi-gradient);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .hero p {
                font-size: 1.05rem;
                color: var(--vi-text-muted);
                margin-bottom: 2rem;
                line-height: 1.65;
            }

            .hero-actions {
                display: flex;
                gap: 1rem;
                align-items: center;
                flex-wrap: wrap;
                margin-bottom: 2.5rem;
            }

            .hero-stats {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 1.5rem;
                padding-top: 1.75rem;
                border-top: 1px solid rgba(124,58,237,0.18);
            }

            .stat-number {
                font-size: 1.75rem;
                font-weight: 800;
                background: var(--vi-gradient);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                line-height: 1.2;
            }

            .stat-label {
                font-size: 0.75rem;
                color: var(--vi-text-muted);
                margin-top: 0.2rem;
                font-weight: 500;
            }

            /* Hero Showcase Card (Visual Travel Preview) */
            .hero-visual-card {
                position: relative;
                border-radius: 1.75rem;
                background: linear-gradient(145deg, rgba(25, 18, 55, 0.85), rgba(12, 12, 30, 0.95));
                border: 1px solid rgba(124, 58, 237, 0.35);
                padding: 1.5rem;
                box-shadow: 
                    0 0 50px rgba(124, 58, 237, 0.2),
                    0 25px 60px rgba(0, 0, 0, 0.6);
                backdrop-filter: blur(16px);
                animation: cardFloat 6s ease-in-out infinite alternate;
            }

            @keyframes cardFloat {
                0% { transform: translateY(0); }
                100% { transform: translateY(-10px); }
            }

            .hero-card-img-wrap {
                position: relative;
                width: 100%;
                height: 230px;
                border-radius: 1.25rem;
                overflow: hidden;
                margin-bottom: 1.25rem;
            }

            .hero-card-img-wrap img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.6s ease;
            }

            .hero-visual-card:hover .hero-card-img-wrap img {
                transform: scale(1.05);
            }

            .hero-card-badge {
                position: absolute;
                top: 1rem;
                left: 1rem;
                background: rgba(15, 15, 35, 0.85);
                backdrop-filter: blur(8px);
                border: 1px solid rgba(0,212,255,0.4);
                padding: 0.35rem 0.75rem;
                border-radius: 9999px;
                font-size: 0.725rem;
                font-weight: 600;
                color: #00d4ff;
                display: flex;
                align-items: center;
                gap: 0.4rem;
            }

            .hero-card-price {
                position: absolute;
                bottom: 1rem;
                right: 1rem;
                background: rgba(124, 58, 237, 0.85);
                backdrop-filter: blur(8px);
                padding: 0.35rem 0.85rem;
                border-radius: 0.75rem;
                font-size: 0.85rem;
                font-weight: 700;
                color: #ffffff;
            }

            .hero-card-info h3 {
                font-size: 1.2rem;
                font-weight: 700;
                color: #ffffff;
                margin-bottom: 0.35rem;
            }

            .hero-card-meta {
                display: flex;
                align-items: center;
                gap: 1.25rem;
                font-size: 0.8rem;
                color: var(--vi-text-muted);
                margin-bottom: 1rem;
            }

            .hero-card-itinerary {
                background: rgba(10, 10, 26, 0.6);
                border: 1px solid rgba(124, 58, 237, 0.2);
                border-radius: 0.85rem;
                padding: 0.75rem 1rem;
                display: flex;
                align-items: center;
                justify-content: space-between;
                font-size: 0.8rem;
            }

            .hero-floating-pill {
                position: absolute;
                background: rgba(15, 15, 35, 0.9);
                border: 1px solid rgba(124, 58, 237, 0.4);
                backdrop-filter: blur(12px);
                border-radius: 1rem;
                padding: 0.6rem 1rem;
                display: flex;
                align-items: center;
                gap: 0.6rem;
                font-size: 0.775rem;
                font-weight: 600;
                box-shadow: 0 10px 25px rgba(0,0,0,0.4);
            }

            .pill-top-right {
                top: -1.25rem;
                right: -1.25rem;
                border-color: rgba(16, 185, 129, 0.5);
                color: #34d399;
            }

            .pill-bottom-left {
                bottom: -1.25rem;
                left: -1.25rem;
                border-color: rgba(0, 212, 255, 0.4);
                color: #00d4ff;
            }

            /* ===== GENERAL SECTIONS ===== */
            section {
                position: relative;
                z-index: 1;
                padding: 6.5rem 2.5rem;
            }

            .container {
                max-width: 1240px;
                margin: 0 auto;
            }

            .section-header {
                text-align: center;
                margin-bottom: 4rem;
            }

            .section-header h2 {
                font-size: clamp(1.9rem, 3.5vw, 2.75rem);
                font-weight: 800;
                margin-bottom: 1rem;
                letter-spacing: -0.02em;
                color: #ffffff;
            }

            .section-header p {
                font-size: 1.05rem;
                color: var(--vi-text-muted);
                max-width: 650px;
                margin: 0 auto;
            }

            /* ===== DESTINATIONS & PACKAGES SHOWCASE ===== */
            .destinations-grid {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 1.75rem;
            }

            .dest-card {
                background: linear-gradient(150deg, rgba(20, 15, 45, 0.75), rgba(10, 10, 26, 0.9));
                border: 1px solid var(--vi-border);
                border-radius: 1.5rem;
                overflow: hidden;
                transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
                display: flex;
                flex-direction: column;
            }

            .dest-card:hover {
                transform: translateY(-8px);
                border-color: rgba(0, 212, 255, 0.45);
                box-shadow: 0 15px 35px rgba(124, 58, 237, 0.25), 0 0 20px rgba(0, 212, 255, 0.15);
            }

            .dest-img-wrap {
                position: relative;
                width: 100%;
                height: 190px;
                overflow: hidden;
            }

            .dest-img-wrap img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.5s ease;
            }

            .dest-card:hover .dest-img-wrap img {
                transform: scale(1.08);
            }

            .dest-tag {
                position: absolute;
                top: 0.85rem;
                left: 0.85rem;
                background: rgba(10, 10, 26, 0.85);
                backdrop-filter: blur(6px);
                border: 1px solid rgba(124, 58, 237, 0.3);
                padding: 0.25rem 0.65rem;
                border-radius: 9999px;
                font-size: 0.7rem;
                font-weight: 600;
                color: #00d4ff;
            }

            .dest-body {
                padding: 1.25rem;
                display: flex;
                flex-direction: column;
                flex: 1;
            }

            .dest-body h3 {
                font-size: 1.05rem;
                font-weight: 700;
                color: #ffffff;
                margin-bottom: 0.35rem;
            }

            .dest-body p {
                font-size: 0.825rem;
                color: var(--vi-text-muted);
                margin-bottom: 1rem;
                line-height: 1.5;
                flex: 1;
            }

            .dest-footer {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding-top: 0.85rem;
                border-top: 1px solid rgba(124, 58, 237, 0.15);
                font-size: 0.8rem;
            }

            .dest-price {
                font-weight: 700;
                color: #34d399;
            }

            .dest-rating {
                color: #f59e0b;
                display: flex;
                align-items: center;
                gap: 0.25rem;
            }

            /* ===== FEATURES SECTION ===== */
            .features-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 2rem;
            }

            .feature-card {
                background: linear-gradient(145deg, rgba(20, 15, 45, 0.65), rgba(10, 10, 26, 0.85));
                border: 1px solid var(--vi-border);
                border-radius: 1.5rem;
                padding: 2.25rem;
                transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
                position: relative;
            }

            .feature-card:hover {
                transform: translateY(-6px);
                border-color: rgba(124, 58, 237, 0.5);
                box-shadow: 0 15px 35px rgba(124, 58, 237, 0.2);
            }

            .feature-icon-box {
                width: 3.5rem;
                height: 3.5rem;
                border-radius: 1rem;
                background: rgba(124, 58, 237, 0.15);
                border: 1px solid rgba(124, 58, 237, 0.35);
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 1.5rem;
                color: #00d4ff;
            }

            .feature-card h3 {
                font-size: 1.25rem;
                font-weight: 700;
                color: #ffffff;
                margin-bottom: 0.75rem;
            }

            .feature-card p {
                font-size: 0.9rem;
                color: var(--vi-text-muted);
                line-height: 1.6;
            }

            /* ===== BENEFITS / WORKFLOW ===== */
            .benefits-wrap {
                background: linear-gradient(180deg, rgba(15, 12, 35, 0.7), rgba(8, 8, 20, 0.95));
                border: 1px solid var(--vi-border);
                border-radius: 2rem;
                padding: 4rem 3.5rem;
            }

            .benefits-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 2rem;
            }

            .benefit-item {
                display: flex;
                gap: 1rem;
                align-items: flex-start;
            }

            .benefit-check {
                width: 2rem;
                height: 2rem;
                min-width: 2rem;
                border-radius: 50%;
                background: rgba(16, 185, 129, 0.15);
                border: 1px solid rgba(16, 185, 129, 0.4);
                color: #34d399;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 0.85rem;
                font-weight: 700;
            }

            .benefit-item h4 {
                font-size: 1.05rem;
                font-weight: 700;
                color: #ffffff;
                margin-bottom: 0.35rem;
            }

            .benefit-item p {
                font-size: 0.85rem;
                color: var(--vi-text-muted);
                line-height: 1.55;
            }

            /* ===== CTA SECTION ===== */
            .cta-section {
                padding: 5rem 2.5rem 7rem;
            }

            .cta-card {
                background: linear-gradient(135deg, rgba(30, 20, 65, 0.9), rgba(10, 15, 35, 0.95));
                border: 1px solid rgba(124, 58, 237, 0.4);
                border-radius: 2rem;
                padding: 4.5rem 3rem;
                text-align: center;
                box-shadow: 0 0 60px rgba(124, 58, 237, 0.25);
                max-width: 1000px;
                margin: 0 auto;
                position: relative;
                overflow: hidden;
            }

            .cta-card::before {
                content: '';
                position: absolute;
                top: -50%;
                left: -50%;
                width: 200%;
                height: 200%;
                background: radial-gradient(circle at 50% 50%, rgba(0, 212, 255, 0.08) 0%, transparent 60%);
                pointer-events: none;
            }

            .cta-card h2 {
                font-size: clamp(2rem, 3.5vw, 2.85rem);
                font-weight: 800;
                color: #ffffff;
                margin-bottom: 1rem;
            }

            .cta-card p {
                font-size: 1.1rem;
                color: var(--vi-text-muted);
                max-width: 600px;
                margin: 0 auto 2.5rem;
                line-height: 1.6;
            }

            /* ===== FOOTER ===== */
            .footer {
                border-top: 1px solid var(--vi-border);
                background: rgba(8, 8, 20, 0.95);
                padding: 3.5rem 2.5rem 2.5rem;
                position: relative;
                z-index: 1;
            }

            .footer-content {
                max-width: 1240px;
                margin: 0 auto;
                display: flex;
                align-items: center;
                justify-content: space-between;
                flex-wrap: wrap;
                gap: 2rem;
            }

            .footer-brand {
                display: flex;
                align-items: center;
                gap: 0.85rem;
            }

            .footer-logo {
                height: 2.25rem;
                width: auto;
            }

            .footer-name {
                font-size: 1.1rem;
                font-weight: 700;
                color: #ffffff;
            }

            .footer-links {
                display: flex;
                gap: 2rem;
                list-style: none;
            }

            .footer-links a {
                color: var(--vi-text-muted);
                text-decoration: none;
                font-size: 0.875rem;
                transition: color 0.2s ease;
            }

            .footer-links a:hover {
                color: #ffffff;
            }

            .footer-copy {
                width: 100%;
                text-align: center;
                padding-top: 2rem;
                margin-top: 2rem;
                border-top: 1px solid rgba(124, 58, 237, 0.1);
                color: #64748b;
                font-size: 0.8rem;
            }

            /* ===== DEMO MODAL ===== */
            .modal-overlay {
                position: fixed;
                inset: 0;
                z-index: 99999;
                background: rgba(5, 5, 18, 0.88);
                backdrop-filter: blur(18px) saturate(180%);
                display: none;
                align-items: center;
                justify-content: center;
                padding: 1.5rem;
                overflow-y: auto;
            }

            .modal-overlay.active {
                display: flex;
            }

            .modal {
                background: linear-gradient(150deg, rgba(22, 16, 45, 0.98), rgba(10, 10, 26, 0.99));
                border: 1px solid rgba(124, 58, 237, 0.4);
                border-radius: 1.5rem;
                padding: 2.25rem;
                max-width: 36rem;
                width: 100%;
                position: relative;
                box-shadow: 0 0 50px rgba(124, 58, 237, 0.3), 0 25px 60px rgba(0,0,0,0.8);
                animation: modalScale 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            }

            @keyframes modalScale {
                from { opacity: 0; transform: scale(0.92) translateY(12px); }
                to { opacity: 1; transform: scale(1) translateY(0); }
            }

            .modal-close {
                position: absolute;
                top: 1.5rem;
                right: 1.5rem;
                background: rgba(255, 255, 255, 0.08);
                border: 1px solid rgba(255, 255, 255, 0.12);
                color: #cbd5e1;
                font-size: 1.5rem;
                line-height: 1;
                width: 2.25rem;
                height: 2.25rem;
                border-radius: 50%;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.2s;
            }

            .modal-close:hover {
                background: rgba(239, 68, 68, 0.25);
                color: #f87171;
                transform: rotate(90deg);
            }

            .modal-badge {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                padding: 0.25rem 0.75rem;
                border-radius: 9999px;
                background: rgba(124, 58, 237, 0.2);
                border: 1px solid rgba(124, 58, 237, 0.4);
                font-size: 0.725rem;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                color: #00d4ff;
                margin-bottom: 0.5rem;
            }

            .modal h2 {
                font-size: 1.45rem;
                font-weight: 700;
                color: #ffffff;
                margin-bottom: 0.35rem;
            }

            .modal-desc {
                font-size: 0.875rem;
                color: #94a3b8;
                margin-bottom: 1.5rem;
                line-height: 1.45;
            }

            .form-row {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 1rem;
            }

            .form-group {
                margin-bottom: 1.1rem;
                display: flex;
                flex-direction: column;
                gap: 0.35rem;
                text-align: left;
            }

            .form-group label {
                font-size: 0.8rem;
                font-weight: 600;
                color: #c4b5fd;
            }

            .form-group input,
            .form-group select,
            .form-group textarea {
                width: 100%;
                padding: 0.65rem 0.9rem;
                background: rgba(10, 10, 26, 0.85);
                border: 1px solid rgba(124, 58, 237, 0.35);
                border-radius: 0.75rem;
                color: #ffffff;
                font-size: 0.875rem;
                font-family: inherit;
                outline: none;
                transition: all 0.2s ease;
            }

            .form-group select option {
                background: #0f0f23;
                color: #e0e7ff;
            }

            .form-group input:focus,
            .form-group select:focus,
            .form-group textarea:focus {
                border-color: #00d4ff;
                box-shadow: 0 0 0 3px rgba(0, 212, 255, 0.2);
            }

            .form-error {
                font-size: 0.75rem;
                color: #f87171;
                display: none;
                margin-top: 0.2rem;
            }

            .form-error.visible {
                display: block;
            }

            .form-success {
                display: none;
                text-align: center;
                padding: 2rem 1rem;
            }

            .form-success.visible {
                display: block;
            }

            .form-success-icon {
                width: 4rem;
                height: 4rem;
                margin: 0 auto 1.25rem;
                border-radius: 50%;
                background: rgba(16, 185, 129, 0.15);
                border: 2px solid rgba(16, 185, 129, 0.4);
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 0 25px rgba(16, 185, 129, 0.35);
                color: #34d399;
            }

            /* Scroll Reveal */
            .reveal {
                opacity: 0;
                transform: translateY(20px);
                transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
            }

            .reveal.visible {
                opacity: 1;
                transform: translateY(0);
            }

            /* Responsive */
            @media (max-width: 1024px) {
                .hero-container {
                    grid-template-columns: 1fr;
                    text-align: center;
                    gap: 3rem;
                }
                .hero-actions { justify-content: center; }
                .hero-stats { justify-content: center; }
                .destinations-grid { grid-template-columns: repeat(2, 1fr); }
                .features-grid { grid-template-columns: repeat(2, 1fr); }
                .benefits-grid { grid-template-columns: repeat(2, 1fr); }
            }

            @media (max-width: 768px) {
                .navbar { padding: 1rem 1.5rem; }
                .mobile-menu-btn { display: block; }
                .nav-links {
                    position: fixed;
                    top: 4.5rem;
                    left: 0;
                    right: 0;
                    background: rgba(10,10,26,0.98);
                    backdrop-filter: blur(20px);
                    flex-direction: column;
                    padding: 2rem;
                    gap: 1.5rem;
                    border-bottom: 1px solid var(--vi-border);
                    display: none;
                }
                .nav-links.open { display: flex; }
                .hero { padding: 6.5rem 1.5rem 3rem; }
                .hero-stats { grid-template-columns: repeat(2, 1fr); gap: 1rem; }
                .destinations-grid { grid-template-columns: 1fr; }
                .features-grid { grid-template-columns: 1fr; }
                .benefits-grid { grid-template-columns: 1fr; }
                .form-row { grid-template-columns: 1fr; }
                .benefits-wrap { padding: 2.5rem 1.5rem; }
                .cta-card { padding: 3rem 1.5rem; }
            }
        </style>
    </head>
    <body>
        <!-- Background Orbs -->
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
                <li><a href="#destinations" class="nav-item-link">Destinations</a></li>
                <li><a href="#features" class="nav-item-link">CRM Features</a></li>
                <li><a href="#benefits" class="nav-item-link">Agency Benefits</a></li>
                <li><a href="{{ url('/admin/login') }}" class="btn btn-ghost">Sign In</a></li>
                <li><a href="#" class="btn btn-primary" id="nav-demo-btn">Request Demo</a></li>
            </ul>
        </nav>

        <!-- Hero Section -->
        <section class="hero" id="hero">
            <div class="hero-container">
                <!-- Left: Pitch & CTAs -->
                <div class="hero-content">
                    <div class="hero-badge">
                        <span class="hero-badge-dot"></span>
                        Next-Gen Travel Agency Management Platform
                    </div>
                    <h1>
                        Empower Your Agency with<br>
                        <span class="gradient-text">Intelligent Travel CRM</span>
                    </h1>
                    <p>
                        From tailor-made luxury itineraries to group departures and automated billing: streamline client relationships, accelerate bookings, and elevate traveler satisfaction.
                    </p>
                    <div class="hero-actions">
                        <a href="#" class="btn btn-primary" id="hero-demo-btn">
                            ✨ Request a Demo
                        </a>
                        <a href="#destinations" class="btn btn-secondary">
                            Explore Platform Tour →
                        </a>
                    </div>
                    <div class="hero-stats">
                        <div class="stat-item">
                            <div class="stat-number">500+</div>
                            <div class="stat-label">Agencies Powered</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">50K+</div>
                            <div class="stat-label">Bookings Managed</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">99.9%</div>
                            <div class="stat-label">Platform Uptime</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">15+</div>
                            <div class="stat-label">Currencies & Gateways</div>
                        </div>
                    </div>
                </div>

                <!-- Right: Visual Travel CRM Card -->
                <div class="hero-visual-card">
                    <div class="hero-floating-pill pill-top-right">
                        <span>⚡ Departure Confirmed • 12 Travelers</span>
                    </div>

                    <div class="hero-card-img-wrap">
                        <img 
                            src="https://images.unsplash.com/photo-1533105079780-92b9be482077?w=800&auto=format&fit=crop&q=80" 
                            alt="Amalfi Coast Mediterranean Tour" 
                            loading="lazy"
                        >
                        <span class="hero-card-badge">
                            <span class="hero-badge-dot"></span> Luxury FIT Package
                        </span>
                        <span class="hero-card-price">$4,850 / person</span>
                    </div>

                    <div class="hero-card-info">
                        <h3>Amalfi Coast & Capri Private Yacht Charter</h3>
                        <div class="hero-card-meta">
                            <span>📅 8 Days, 7 Nights</span>
                            <span>⭐ 4.95 (38 Reviews)</span>
                            <span>👥 Private Group</span>
                        </div>
                        <div class="hero-card-itinerary">
                            <div>
                                <span style="color: #00d4ff; font-weight: 600;">Day 4 Itinerary:</span>
                                <span style="color: #cbd5e1; margin-left: 4px;">Capri Blue Grotto & Sunset Sail</span>
                            </div>
                            <span style="color: #34d399; font-weight: 600;">Invoice Paid</span>
                        </div>
                    </div>

                    <div class="hero-floating-pill pill-bottom-left">
                        <span>💳 Automated Stripe & HBL Payments</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Destinations & Tours Showcase Section -->
        <section id="destinations">
            <div class="container">
                <div class="section-header reveal">
                    <h2>Engineered for Every Travel Specialty</h2>
                    <p>Whether you manage bespoke luxury itineraries, scheduled group departures, or international corporate tours, VI Studio adapts to your agency's exact workflow.</p>
                </div>
                <div class="destinations-grid">
                    <!-- Dest 1 -->
                    <div class="dest-card reveal">
                        <div class="dest-img-wrap">
                            <img src="https://images.unsplash.com/photo-1514282401047-d79a71a590e8?w=800&auto=format&fit=crop&q=80" alt="Maldives Overwater Sanctuary" loading="lazy">
                            <span class="dest-tag">Luxury Honeymoons</span>
                        </div>
                        <div class="dest-body">
                            <h3>Maldives Overwater Lagoon Retreat</h3>
                            <p>Private water villas, seaplane transfers, and bespoke dining itineraries created in minutes with our package builder.</p>
                            <div class="dest-footer">
                                <span class="dest-price">From $5,400</span>
                                <span class="dest-rating">★ 4.98</span>
                            </div>
                        </div>
                    </div>

                    <!-- Dest 2 -->
                    <div class="dest-card reveal">
                        <div class="dest-img-wrap">
                            <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=800&auto=format&fit=crop&q=80" alt="Swiss Alps Glacier Expedition" loading="lazy">
                            <span class="dest-tag">Fixed Departures</span>
                        </div>
                        <div class="dest-body">
                            <h3>Swiss Alps & Glacier Express</h3>
                            <p>Multi-day scenic railway journeys with automated slot allocation, group discounts, and waitlist management.</p>
                            <div class="dest-footer">
                                <span class="dest-price">From $3,850</span>
                                <span class="dest-rating">★ 4.92</span>
                            </div>
                        </div>
                    </div>

                    <!-- Dest 3 -->
                    <div class="dest-card reveal">
                        <div class="dest-img-wrap">
                            <img src="https://images.unsplash.com/photo-1516426122078-c23e76319801?w=800&auto=format&fit=crop&q=80" alt="Serengeti Big 5 Wildlife Safari" loading="lazy">
                            <span class="dest-tag">Adventure Safari</span>
                        </div>
                        <div class="dest-body">
                            <h3>Serengeti & Ngorongoro Big 5 Safari</h3>
                            <p>All-inclusive 4x4 game drives, tented luxury lodges, visa documentation, and automated traveler insurance checks.</p>
                            <div class="dest-footer">
                                <span class="dest-price">From $4,200</span>
                                <span class="dest-rating">★ 4.96</span>
                            </div>
                        </div>
                    </div>

                    <!-- Dest 4 -->
                    <div class="dest-card reveal">
                        <div class="dest-img-wrap">
                            <img src="https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?w=800&auto=format&fit=crop&q=80" alt="Kyoto Cultural Heritage Tour" loading="lazy">
                            <span class="dest-tag">Cultural Immersions</span>
                        </div>
                        <div class="dest-body">
                            <h3>Kyoto & Mount Fuji Heritage Journey</h3>
                            <p>Tea ceremonies, private ryokan stays, bullet train reservations, and interactive customer portal vouchers.</p>
                            <div class="dest-footer">
                                <span class="dest-price">From $3,650</span>
                                <span class="dest-rating">★ 4.94</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features">
            <div class="container">
                <div class="section-header reveal">
                    <h2>Everything Your Travel Agency Needs</h2>
                    <p>A unified cloud architecture purpose-built to eliminate manual spreadsheets, accelerate payments, and scale operations effortlessly.</p>
                </div>
                <div class="features-grid">
                    <div class="feature-card reveal">
                        <div class="feature-icon-box">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
                        </div>
                        <h3>Intelligent Booking Lifecycle</h3>
                        <p>Track inquiries, quotes, confirmations, and cancellations with ease. Automated status transitions keep your agents and travelers synchronized.</p>
                    </div>

                    <div class="feature-card reveal">
                        <div class="feature-icon-box">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                        <h3>Complete Traveler CRM</h3>
                        <p>Store traveler preferences, dietary restrictions, passport files, and booking history. Build lifelong customer loyalty with personalized service.</p>
                    </div>

                    <div class="feature-card reveal">
                        <div class="feature-icon-box">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                        </div>
                        <h3>Invoicing & Payment Gateways</h3>
                        <p>Generate professional PDF invoices with single-click payments. Deep integration with Stripe, HBL, and direct bank transfers with multi-currency support.</p>
                    </div>

                    <div class="feature-card reveal">
                        <div class="feature-icon-box">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        </div>
                        <h3>Visual Itinerary & Package Builder</h3>
                        <p>Design multi-day tour itineraries with inclusions, exclusions, accommodations, and pricing tiers. Publish immediately to your customer booking site.</p>
                    </div>

                    <div class="feature-card reveal">
                        <div class="feature-icon-box">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        </div>
                        <h3>Real-Time Revenue Analytics</h3>
                        <p>Track cash flow, departure profitability, agent commissions, and seasonal demand through interactive Filament dashboard widgets.</p>
                    </div>

                    <div class="feature-card reveal">
                        <div class="feature-icon-box">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <h3>Automated Email Campaigns</h3>
                        <p>Send branded itinerary updates, payment receipts, balance reminders, and promotional tour blasts with custom agency SMTP settings.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Benefits & Architecture -->
        <section class="benefits" id="benefits">
            <div class="container">
                <div class="benefits-wrap">
                    <div class="section-header reveal">
                        <h2>Why Travel Agencies Choose VI Studio</h2>
                        <p>Enterprise power engineered specifically for travel businesses of all sizes.</p>
                    </div>
                    <div class="benefits-grid">
                        <div class="benefit-item reveal">
                            <div class="benefit-check">✓</div>
                            <div>
                                <h4>Dedicated Agency Subdomains</h4>
                                <p>Each agency receives an isolated branded domain with custom logos, favicons, and bespoke theme colors.</p>
                            </div>
                        </div>

                        <div class="benefit-item reveal">
                            <div class="benefit-check">✓</div>
                            <div>
                                <h4>Client Self-Service Portal</h4>
                                <p>Delight travelers with a dedicated portal where they download vouchers, review itineraries, and settle invoices.</p>
                            </div>
                        </div>

                        <div class="benefit-item reveal">
                            <div class="benefit-check">✓</div>
                            <div>
                                <h4>Granular Role-Based Permissions</h4>
                                <p>Control staff access with customizable roles for Super Admins, Branch Managers, Booking Agents, and Accountants.</p>
                            </div>
                        </div>

                        <div class="benefit-item reveal">
                            <div class="benefit-check">✓</div>
                            <div>
                                <h4>Gift Voucher Engine</h4>
                                <p>Sell digital travel gift vouchers online with unique redemption codes, balance tracking, and expiration rules.</p>
                            </div>
                        </div>

                        <div class="benefit-item reveal">
                            <div class="benefit-check">✓</div>
                            <div>
                                <h4>PostgreSQL & Cloud Infrastructure</h4>
                                <p>Reliable cloud architecture with automated database backups, secure sessions, and sub-second load times worldwide.</p>
                            </div>
                        </div>

                        <div class="benefit-item reveal">
                            <div class="benefit-check">✓</div>
                            <div>
                                <h4>Full Mobile Responsiveness</h4>
                                <p>Manage departures, verify client payments, and respond to inquiries whether you're at your desk or in transit.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta-section" id="cta">
            <div class="cta-card reveal">
                <h2>Ready to Elevate Your Travel Agency?</h2>
                <p>Join hundreds of high-growth travel agencies using VI Studio Travel CRM to streamline operations, cut administrative hours, and deliver unforgettable journeys.</p>
                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <a href="#" class="btn btn-primary" id="cta-demo-btn" style="font-size: 1rem; padding: 0.85rem 2rem;">
                        ✨ Request a Demo
                    </a>
                    <a href="{{ url('/admin/login') }}" class="btn btn-ghost" style="font-size: 1rem; padding: 0.85rem 2rem;">
                        Sign In to Portal →
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
                    <li><a href="#destinations">Destinations</a></li>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#benefits">Agency Benefits</a></li>
                    <li><a href="{{ url('/admin/login') }}">Admin Login</a></li>
                    <li><a href="#" id="footer-demo-btn">Request Demo</a></li>
                </ul>
                <div class="footer-copy">
                    &copy; {{ date('Y') }} VI Studio Travel CRM. All rights reserved. Powered by Virtual Intelligence.
                </div>
            </div>
        </footer>

        <!-- Demo Request Modal -->
        <div class="modal-overlay" id="demo-modal" role="dialog" aria-hidden="true">
            <div class="modal">
                <button class="modal-close" id="modal-close" aria-label="Close modal">&times;</button>
                <div class="modal-badge">
                    <span class="hero-badge-dot"></span>
                    VI Studio Travel CRM
                </div>
                <h2>Request a Personalized Demo</h2>
                <p class="modal-desc">Tell us about your agency and our team will configure a personalized demo environment.</p>

                <div class="form-success" id="form-success">
                    <div class="form-success-icon">
                        <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <h3 style="font-size: 1.3rem; margin-bottom: 0.5rem; color: #ffffff;">Demo Request Received!</h3>
                    <p style="color: #a5b4fc; font-size: 0.9rem; margin-bottom: 1.5rem;">Thank you! Our travel operations specialists will contact you within 24 hours with your login access.</p>
                    <button type="button" class="btn btn-primary" id="modal-success-close" style="padding: 0.65rem 2rem;">Done</button>
                </div>

                <form id="demo-form">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label for="demo-name">Full Name *</label>
                            <input type="text" id="demo-name" name="name" placeholder="Sarah Jenkins" required autocomplete="name">
                            <div class="form-error" id="error-name">Please enter your name</div>
                        </div>
                        <div class="form-group">
                            <label for="demo-email">Work Email *</label>
                            <input type="email" id="demo-email" name="email" placeholder="sarah@agency.com" required autocomplete="email">
                            <div class="form-error" id="error-email">Please enter a valid work email</div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="demo-company">Agency / Organization *</label>
                            <input type="text" id="demo-company" name="company" placeholder="e.g. Apex Journeys" required autocomplete="organization">
                            <div class="form-error" id="error-company">Please enter your agency name</div>
                        </div>
                        <div class="form-group">
                            <label for="demo-focus">Primary Specialty</label>
                            <select id="demo-focus" name="focus">
                                <option value="Luxury & Tailor-Made">Luxury & Tailor-Made Tours</option>
                                <option value="Group & Adventure Travel">Group & Adventure Departures</option>
                                <option value="Corporate & MICE">Corporate & MICE Travel</option>
                                <option value="Destination Management Company (DMC)">DMC (Destination Management)</option>
                                <option value="Independent Agency">Independent Travel Consultant</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="demo-message">Specific Requirements or Inquiries</label>
                        <textarea id="demo-message" name="message" placeholder="Tell us about your team size, current pain points, or destination requirements..." rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" id="demo-submit" style="width: 100%; padding: 0.85rem; font-size: 0.95rem; justify-content: center; margin-top: 0.5rem;">
                        <span id="demo-submit-text">Send Demo Request</span>
                        <span id="demo-submit-spinner" style="display: none;">Sending Request...</span>
                    </button>
                </form>
            </div>
        </div>

        <script>
            // === Navbar scroll effect ===
            const navbar = document.getElementById('navbar');
            window.addEventListener('scroll', () => {
                navbar.classList.toggle('scrolled', window.scrollY > 40);
            });

            // === Mobile menu ===
            const mobileBtn = document.getElementById('mobile-menu-btn');
            const navLinks = document.getElementById('nav-links');
            mobileBtn.addEventListener('click', () => {
                navLinks.classList.toggle('open');
                mobileBtn.textContent = navLinks.classList.contains('open') ? '✕' : '☰';
            });
            // Close mobile menu on link click
            document.querySelectorAll('.nav-links a').forEach(a => {
                a.addEventListener('click', () => {
                    navLinks.classList.remove('open');
                    mobileBtn.textContent = '☰';
                });
            });

            // === Scroll reveal ===
            const reveals = document.querySelectorAll('.reveal');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, i) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => entry.target.classList.add('visible'), i * 80);
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.08 });
            reveals.forEach(el => observer.observe(el));

            // === Demo Modal ===
            const modal = document.getElementById('demo-modal');
            const modalClose = document.getElementById('modal-close');
            const successClose = document.getElementById('modal-success-close');
            const demoForm = document.getElementById('demo-form');
            const formSuccess = document.getElementById('form-success');

            function openModal(e) {
                if (e) e.preventDefault();
                modal.classList.add('active');
                modal.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
                formSuccess.classList.remove('visible');
                demoForm.style.display = 'block';
                demoForm.reset();
                document.querySelectorAll('.form-error').forEach(el => el.classList.remove('visible'));
                setTimeout(() => document.getElementById('demo-name').focus(), 100);
            }

            function closeModal() {
                modal.classList.remove('active');
                modal.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
            }

            // Attach modal open to all demo buttons
            ['nav-demo-btn', 'hero-demo-btn', 'cta-demo-btn', 'footer-demo-btn'].forEach(id => {
                const el = document.getElementById(id);
                if (el) el.addEventListener('click', openModal);
            });

            if (modalClose) modalClose.addEventListener('click', closeModal);
            if (successClose) successClose.addEventListener('click', closeModal);
            modal.addEventListener('click', (e) => {
                if (e.target === modal) closeModal();
            });
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && modal.classList.contains('active')) closeModal();
            });

            // === Form submission ===
            demoForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                document.querySelectorAll('.form-error').forEach(el => el.classList.remove('visible'));

                const name = document.getElementById('demo-name').value.trim();
                const email = document.getElementById('demo-email').value.trim();
                const company = document.getElementById('demo-company').value.trim();
                const focus = document.getElementById('demo-focus').value;
                const userMsg = document.getElementById('demo-message').value.trim();
                const message = focus ? `[Specialty: ${focus}] ${userMsg}` : userMsg;

                let hasError = false;
                if (!name) {
                    document.getElementById('error-name').classList.add('visible');
                    hasError = true;
                }
                if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                    document.getElementById('error-email').classList.add('visible');
                    hasError = true;
                }
                if (!company) {
                    document.getElementById('error-company').classList.add('visible');
                    hasError = true;
                }
                if (hasError) return;

                const submitBtn = document.getElementById('demo-submit');
                const submitText = document.getElementById('demo-submit-text');
                const submitSpinner = document.getElementById('demo-submit-spinner');
                submitBtn.disabled = true;
                submitText.style.display = 'none';
                submitSpinner.style.display = 'inline-block';

                try {
                    let token = '';
                    const metaToken = document.querySelector('meta[name="csrf-token"]');
                    if (metaToken) token = metaToken.getAttribute('content');

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
                    alert('Something went wrong. Please check your connection and try again.');
                } finally {
                    submitBtn.disabled = false;
                    submitText.style.display = 'inline';
                    submitSpinner.style.display = 'none';
                }
            });
        </script>
    </body>
</html>
