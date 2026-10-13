<?php

namespace App\Http\Controllers;

use App\Console\Commands\BillSubscriptions;
use App\Console\Commands\ExpireGiftVouchers;
use App\Console\Commands\SendBookingReminders;
use App\Console\Commands\SendScheduledCampaigns;
use App\Models\Activity;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

/**
 * Runs the scheduled work from routes/console.php over HTTP, for hosts such as Vercel where no
 * long-running `schedule:work` process exists and a Cron Job can only make a GET request.
 *
 * Protected by the bearer token Vercel sends when a CRON_SECRET environment variable is set
 * (config('services.cron.secret')); with no secret configured the route answers 404, so it can
 * never be called anonymously.
 *
 * Tasks:
 *  - daily:     the four once-a-day commands, run directly. They are not routed through `schedule:run`
 *               because Hobby-plan crons fire at a random minute inside the hour, and `dailyAt()`
 *               entries only run when the clock matches exactly.
 *  - campaigns: queues scheduled email campaigns that are due (the every-minute entry; needs a
 *               per-minute caller, i.e. a Pro plan cron or an external pinger).
 *  - schedule:  `schedule:run` itself, for a per-minute cron on a Pro plan. Use it instead of
 *               `daily` + `campaigns`, never together with them.
 *
 * Cron delivery is best-effort and can repeat, so each task holds a cache lock while it runs.
 */
class CronController extends Controller
{
    public const TASKS = ['daily', 'campaigns', 'schedule'];

    public function __invoke(Request $request, string $task): JsonResponse
    {
        $secret = (string) config('services.cron.secret');

        abort_if($secret === '', 404);
        abort_unless(hash_equals('Bearer '.$secret, (string) $request->header('Authorization')), 401);

        $lock = Cache::lock("internal-cron:{$task}", 600);

        if (! $lock->get()) {
            return response()->json(['task' => $task, 'status' => 'already-running'], 202);
        }

        try {
            $exitCodes = [];

            foreach ($this->commandsFor($task) as [$command, $parameters]) {
                $exitCodes[$command] = Artisan::call($command, $parameters);
            }
        } finally {
            $lock->release();
        }

        $failed = array_filter($exitCodes, fn (int $code): bool => $code !== 0);

        return response()->json(
            ['task' => $task, 'status' => $failed === [] ? 'ok' : 'failed', 'exit_codes' => $exitCodes],
            $failed === [] ? 200 : 500,
        );
    }

    /**
     * @return list<array{0: string, 1: array<string, mixed>}>
     */
    private function commandsFor(string $task): array
    {
        return match ($task) {
            'daily' => [
                [app(ExpireGiftVouchers::class)->getName(), []],
                [app(BillSubscriptions::class)->getName(), []],
                [app(SendBookingReminders::class)->getName(), []],
                ['model:prune', ['--model' => [Activity::class]]],
            ],
            'campaigns' => [[app(SendScheduledCampaigns::class)->getName(), []]],
            'schedule' => [['schedule:run', []]],
        };
    }
}
