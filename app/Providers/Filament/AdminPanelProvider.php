<?php

namespace App\Providers\Filament;

use App\Http\Controllers\InvoicePdfController;
use App\Http\Middleware\EnsurePlatformDomain;
use App\Http\Middleware\ResolvePlatformTeam;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\Width;
use Filament\View\PanelsRenderHook;
use Illuminate\Contracts\View\View;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->authGuard('super_admin')
            ->authPasswordBroker('super_admins')
            ->login()
            ->passwordReset()
            ->brandName('VI Studio Travel CRM')
            ->brandLogo(fn (): string => asset('vi-studio-logo.png'))
            ->brandLogoHeight('3rem')
            ->favicon(fn (): string => asset('vi-studio-favicon.jpg'))
            ->colors([
                'primary' => Color::hex('#7c3aed'),
                'secondary' => Color::hex('#06b6d4'),
                'info' => Color::hex('#00d4ff'),
            ])
            ->renderHook(PanelsRenderHook::HEAD_END, fn (): string => $this->adminThemeStyles())
            ->renderHook(PanelsRenderHook::AUTH_LOGIN_FORM_AFTER, fn (): View => view('filament.auth.demo-request'))
            ->maxContentWidth(Width::Full)
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->middleware([
                EnsurePlatformDomain::class,
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ResolvePlatformTeam::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authenticatedRoutes(fn () => Route::get('tenant-invoices/{invoice}/pdf', [InvoicePdfController::class, 'admin'])->whereNumber('invoice')->name('tenant-invoices.pdf'))
            ->authMiddleware([
                Authenticate::class,
                ResolvePlatformTeam::class,
            ], isPersistent: true)
            ->persistentMiddleware([EnsurePlatformDomain::class]);
    }

    /**
     * Injects VI Studio travel-themed CSS overrides into the admin panel: neon purple/cyan gradients,
     * smooth micro-animations, glassmorphism effects, and a branded login experience.
     */
    private function adminThemeStyles(): string
    {
        return <<<'CSS'
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <style>
            :root {
                --vi-neon-blue: #00d4ff;
                --vi-neon-purple: #7c3aed;
                --vi-neon-cyan: #06b6d4;
                --vi-dark-bg: #0a0a1a;
                --vi-card-bg: rgba(15, 15, 35, 0.85);
                --vi-glass: rgba(124, 58, 237, 0.08);
            }

            /* Global font override */
            body, .fi-body {
                font-family: 'Inter', ui-sans-serif, system-ui, sans-serif !important;
            }

            /* Login page overhaul */
            .fi-simple-layout {
                background: linear-gradient(135deg, #0a0a1a 0%, #1a0a2e 25%, #0d1b2a 50%, #1a0a2e 75%, #0a0a1a 100%) !important;
                min-height: 100vh;
                position: relative;
                overflow: hidden;
            }

            .fi-simple-layout::before {
                content: '';
                position: absolute;
                top: -50%;
                left: -50%;
                width: 200%;
                height: 200%;
                background:
                    radial-gradient(circle at 20% 50%, rgba(124, 58, 237, 0.15) 0%, transparent 50%),
                    radial-gradient(circle at 80% 20%, rgba(0, 212, 255, 0.1) 0%, transparent 50%),
                    radial-gradient(circle at 50% 80%, rgba(6, 182, 212, 0.08) 0%, transparent 50%);
                animation: vi-aurora 20s ease-in-out infinite;
                pointer-events: none;
            }

            @keyframes vi-aurora {
                0%, 100% { transform: translate(0, 0) rotate(0deg); }
                33% { transform: translate(30px, -30px) rotate(1deg); }
                66% { transform: translate(-20px, 20px) rotate(-1deg); }
            }

            .fi-simple-layout .fi-simple-main-ctn {
                position: relative;
                z-index: 10;
            }

            .fi-simple-layout .fi-simple-page {
                background: rgba(15, 15, 35, 0.75) !important;
                backdrop-filter: blur(20px) saturate(180%) !important;
                border: 1px solid rgba(124, 58, 237, 0.2) !important;
                border-radius: 1.5rem !important;
                box-shadow:
                    0 0 40px rgba(124, 58, 237, 0.12),
                    0 0 80px rgba(0, 212, 255, 0.06),
                    0 25px 50px rgba(0, 0, 0, 0.25) !important;
            }

            .fi-simple-layout .fi-simple-page .fi-form-component-container label,
            .fi-simple-layout .fi-simple-page .fi-fo-field-wrp label {
                color: #c4b5fd !important;
            }

            .fi-simple-layout .fi-simple-page h2,
            .fi-simple-layout .fi-simple-page .fi-header-heading {
                color: #e0e7ff !important;
            }

            /* Sidebar styling */
            .fi-sidebar {
                background: linear-gradient(180deg, #0f0f23 0%, #1a0a2e 100%) !important;
                border-right: 1px solid rgba(124, 58, 237, 0.15) !important;
            }

            .fi-sidebar .fi-sidebar-nav-groups {
                padding: 0.5rem;
            }

            .fi-sidebar-item {
                transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
                border-radius: 0.75rem !important;
                margin: 2px 0 !important;
            }

            .fi-sidebar-item:hover {
                background: rgba(124, 58, 237, 0.12) !important;
                transform: translateX(4px);
            }

            .fi-sidebar-item.fi-active {
                background: linear-gradient(135deg, rgba(124, 58, 237, 0.2), rgba(6, 182, 212, 0.15)) !important;
                border-left: 3px solid var(--vi-neon-purple) !important;
            }

            .fi-sidebar-item-label {
                color: #a5b4fc !important;
                font-weight: 500 !important;
            }

            .fi-sidebar-item.fi-active .fi-sidebar-item-label {
                color: #e0e7ff !important;
                font-weight: 600 !important;
            }

            .fi-sidebar-item-icon {
                color: #7c3aed !important;
            }

            .fi-sidebar-item.fi-active .fi-sidebar-item-icon {
                color: var(--vi-neon-cyan) !important;
            }

            /* Top header bar */
            .fi-topbar {
                background: rgba(15, 15, 35, 0.9) !important;
                backdrop-filter: blur(12px) saturate(150%) !important;
                border-bottom: 1px solid rgba(124, 58, 237, 0.15) !important;
            }

            /* Logo glow effect */
            img.fi-logo {
                filter: drop-shadow(0 0 8px rgba(124, 58, 237, 0.4));
                transition: filter 0.3s ease !important;
            }

            img.fi-logo:hover {
                filter: drop-shadow(0 0 16px rgba(0, 212, 255, 0.6));
            }

            /* Buttons */
            .fi-btn-primary,
            .fi-btn.fi-color-primary {
                background: linear-gradient(135deg, #7c3aed, #06b6d4) !important;
                border: none !important;
                box-shadow: 0 4px 15px rgba(124, 58, 237, 0.3) !important;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
                border-radius: 0.75rem !important;
            }

            .fi-btn-primary:hover,
            .fi-btn.fi-color-primary:hover {
                transform: translateY(-2px) !important;
                box-shadow: 0 8px 25px rgba(124, 58, 237, 0.4) !important;
            }

            .fi-btn-primary:active,
            .fi-btn.fi-color-primary:active {
                transform: translateY(0) !important;
            }

            /* Data table header */
            .fi-ta-header-cell {
                background: rgba(124, 58, 237, 0.06) !important;
            }

            /* Status cards / widgets */
            .fi-wi-stats-overview-stat {
                background: rgba(15, 15, 35, 0.6) !important;
                backdrop-filter: blur(8px) !important;
                border: 1px solid rgba(124, 58, 237, 0.12) !important;
                border-radius: 1rem !important;
                transition: all 0.3s ease !important;
            }

            .fi-wi-stats-overview-stat:hover {
                border-color: rgba(124, 58, 237, 0.3) !important;
                box-shadow: 0 4px 20px rgba(124, 58, 237, 0.1) !important;
                transform: translateY(-2px);
            }

            /* Form inputs */
            .fi-input, .fi-select-input {
                border-radius: 0.75rem !important;
                transition: all 0.2s ease !important;
            }

            .fi-input:focus, .fi-select-input:focus {
                border-color: var(--vi-neon-purple) !important;
                box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.15) !important;
            }

            /* Scrollbar */
            ::-webkit-scrollbar {
                width: 6px;
            }

            ::-webkit-scrollbar-track {
                background: #0f0f23;
            }

            ::-webkit-scrollbar-thumb {
                background: linear-gradient(180deg, #7c3aed, #06b6d4);
                border-radius: 3px;
            }

            /* Floating particles animation for login */
            .fi-simple-layout::after {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-image:
                    radial-gradient(2px 2px at 20px 30px, rgba(124, 58, 237, 0.3), transparent),
                    radial-gradient(2px 2px at 40px 70px, rgba(0, 212, 255, 0.25), transparent),
                    radial-gradient(2px 2px at 50px 160px, rgba(124, 58, 237, 0.2), transparent),
                    radial-gradient(2px 2px at 90px 40px, rgba(6, 182, 212, 0.3), transparent),
                    radial-gradient(2px 2px at 130px 80px, rgba(124, 58, 237, 0.2), transparent),
                    radial-gradient(2px 2px at 160px 30px, rgba(0, 212, 255, 0.2), transparent);
                background-repeat: repeat;
                background-size: 200px 200px;
                animation: vi-sparkle 4s ease-in-out infinite alternate;
                pointer-events: none;
                opacity: 0.6;
            }

            @keyframes vi-sparkle {
                0% { opacity: 0.4; }
                100% { opacity: 0.8; }
            }

            /* Page transition */
            .fi-page {
                animation: vi-fadeInUp 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            }

            @keyframes vi-fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(12px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            /* Badge styling */
            .fi-badge {
                border-radius: 9999px !important;
            }

            /* Modal styling */
            .fi-modal-content {
                border-radius: 1.25rem !important;
                border: 1px solid rgba(124, 58, 237, 0.15) !important;
            }

            /* Notification styling */
            .fi-notification {
                border-radius: 1rem !important;
                border: 1px solid rgba(124, 58, 237, 0.1) !important;
            }
        </style>
        CSS;
    }
}
