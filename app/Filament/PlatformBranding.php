<?php

namespace App\Filament;

use Filament\Panel;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\HtmlString;

/**
 * VI Studio Travel CRM's own look: the official logo, favicon, name and the stylesheet that gives
 * every panel its colours, sidebar, cards, tables and login screen (public/brand/vi-studio.css).
 * The Super Admin panel is fully branded with it; the agency panels keep the agency's own name and
 * logo (see AgencyBranding) but share the same stylesheet and carry a small "Powered by" footer.
 */
class PlatformBranding
{
    public static function apply(Panel $panel): Panel
    {
        return $panel
            ->brandName(fn (): string => config('branding.name'))
            ->brandLogo(fn (): HtmlString => static::logo())
            ->brandLogoHeight('auto')
            ->favicon(asset(config('branding.favicon')))
            ->renderHook(PanelsRenderHook::HEAD_END, fn (): string => static::headTags());
    }

    /**
     * The brand colours every panel starts from, taken from the logo: electric violet and cyan.
     * Agencies still override primary/secondary with their own colours (AgencyBranding).
     *
     * @return array<string, array<int, string>>
     */
    public static function colors(): array
    {
        return [
            'primary' => Color::generatePalette('#7c3aed'),
            'secondary' => Color::generatePalette('#06b6d4'),
            'info' => Color::generatePalette('#2563eb'),
        ];
    }

    /**
     * The logo with the product name beside it. In the sidebar it sits next to "Travel CRM"; on the
     * sign-in screen the stylesheet shows the logo large and hides the text (the logo already
     * carries the company name).
     */
    public static function logo(): HtmlString
    {
        return new HtmlString(view('brand.logo')->render());
    }

    /**
     * Favicon set, theme colour and the shared panel stylesheet, cache-busted by file time so a
     * redeploy always serves the current CSS.
     */
    public static function headTags(): string
    {
        return view('brand.head-tags')->render();
    }

    public static function assetUrl(string $path): string
    {
        $file = public_path($path);

        return asset($path).(is_file($file) ? '?v='.filemtime($file) : '');
    }

    /**
     * Small footer line for panels that are branded as an agency.
     */
    public static function poweredBy(): string
    {
        return view('brand.powered-by')->render();
    }
}
