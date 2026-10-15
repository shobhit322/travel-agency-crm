<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\SaasLeadResource;
use App\Filament\Resources\TenantResource;
use Filament\Widgets\Widget;

/**
 * Branded greeting at the top of the Super Admin dashboard, with shortcuts to the two things the
 * platform owner does most: onboarding agencies and following up demo requests.
 */
class PlatformWelcome extends Widget
{
    protected static bool $isLazy = false;

    protected static ?int $sort = -10;

    protected int|string|array $columnSpan = 'full';

    protected string $view = 'filament.widgets.platform-welcome';

    public static function canView(): bool
    {
        return auth('super_admin')->check();
    }

    /**
     * @return array{name: string, links: array<string, string>}
     */
    protected function getViewData(): array
    {
        return [
            'name' => (string) (auth('super_admin')->user()?->name ?? 'there'),
            'links' => [
                'Demo requests' => SaasLeadResource::getUrl('index'),
                'Agencies' => TenantResource::getUrl('index'),
            ],
        ];
    }
}
