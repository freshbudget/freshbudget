<?php

namespace App\Console;

use App\Domains\Accounts\Models\Account;
use App\Domains\Budgets\Models\BudgetInvitation;
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
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
    }
}
