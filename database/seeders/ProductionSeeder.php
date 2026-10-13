<?php

namespace Database\Seeders;

use App\Models\SubscriptionPlan;
use App\Models\SuperAdmin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use RuntimeException;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

/**
 * Bootstraps an empty production database without any demo data or well-known credentials:
 * countries, platform permissions, system email templates, a free "Starter" plan, and one Super
 * Admin whose email and password come from PLATFORM_ADMIN_EMAIL / PLATFORM_ADMIN_PASSWORD
 * (config/platform.php). Agencies are then created from the Super Admin panel.
 *
 *     php artisan db:seed --class=ProductionSeeder --force
 *
 * Safe to re-run: it never changes the password of an admin that already exists.
 */
class ProductionSeeder extends Seeder
{
    use WithoutModelEvents;

    private const MINIMUM_PASSWORD_LENGTH = 12;

    public function run(): void
    {
        $email = (string) config('platform.bootstrap_admin.email');
        $password = (string) config('platform.bootstrap_admin.password');

        if ($email === '' || mb_strlen($password) < self::MINIMUM_PASSWORD_LENGTH) {
            throw new RuntimeException(
                'Set PLATFORM_ADMIN_EMAIL and a PLATFORM_ADMIN_PASSWORD of at least '.self::MINIMUM_PASSWORD_LENGTH.' characters before running ProductionSeeder.',
            );
        }

        $this->call([CountrySeeder::class, PermissionSeeder::class, EmailTemplateSeeder::class]);

        SubscriptionPlan::query()->firstOrCreate(
            ['name' => 'Starter'],
            ['price' => 0, 'billing_cycle' => 'monthly', 'feature_limits' => ['max_staff' => 5]],
        );

        $admin = SuperAdmin::query()->firstOrCreate(
            ['email' => $email],
            ['name' => (string) config('platform.bootstrap_admin.name'), 'password' => $password, 'status' => 'active'],
        );

        // Super admins use the fixed sentinel team id (0) — see ResolvePlatformTeam.
        app(PermissionRegistrar::class)->setPermissionsTeamId(0);
        $admin->assignRole(Role::findOrCreate('Super Admin', 'super_admin'));
        app(PermissionRegistrar::class)->setPermissionsTeamId(null);
    }
}
