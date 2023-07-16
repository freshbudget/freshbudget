<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use App\Domains\Budgets\Models\BudgetInvitation;
use Spatie\Health\Commands\RunHealthChecksCommand;
use App\Domains\Incomes\Jobs\SyncIncomeEstimatedTaxes;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Domains\Incomes\Jobs\SyncIncomeEstimatedDeductions;
use App\Domains\Incomes\Jobs\SyncIncomeEstimatedEntitlements;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command(RunHealthChecksCommand::class)->everyMinute();
        $schedule->command('model:prune', [
            '--model' => BudgetInvitation::class,
        ])->daily();
        
        $schedule->command('auth:clear-resets')->everyFourHours();

        // TODO: Refactor this to use a parent job that does chaining and batching as required.
        $schedule->job(SyncIncomeEstimatedEntitlements::class)->dailyAt('00:00');
        $schedule->job(SyncIncomeEstimatedTaxes::class)->dailyAt('00:00');
        $schedule->job(SyncIncomeEstimatedDeductions::class)->dailyAt('00:00');
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
    }
}
