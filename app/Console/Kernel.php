<?php

namespace App\Console;

use App\Domains\Incomes\Jobs\SyncIncomeEstimatedEntitlementsEstimate;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        $schedule->job(SyncIncomeEstimatedEntitlementsEstimate::class)->dailyAt('00:00');
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
    }
}
