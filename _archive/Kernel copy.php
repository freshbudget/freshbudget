<?php

namespace App\Console;

use App\Domains\Incomes\Jobs\SyncIncomeEstimatedDeductions;
use App\Domains\Incomes\Jobs\SyncIncomeEstimatedEntitlements;
use App\Domains\Incomes\Jobs\SyncIncomeEstimatedTaxes;
use App\Models\Account;
use App\Models\BudgetInvitation;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('model:prune', [
            '--model' => [BudgetInvitation::class, Account::class],
        ])->dailyAt('00:00');

        $schedule->command('auth:clear-resets')->everyFourHours();

        // TODO: Refactor this to use a parent job that does chaining and batching as required.
        // $schedule->job(SyncIncomeEstimatedEntitlements::class)->dailyAt('00:00');
        // $schedule->job(SyncIncomeEstimatedTaxes::class)->dailyAt('00:00');
        // $schedule->job(SyncIncomeEstimatedDeductions::class)->dailyAt('00:00');
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
    }
}
