<?php

namespace Database\Seeders;

use App\Domains\Incomes\Actions\CreateIncomeEntitlementAction;
use App\Domains\Incomes\Actions\UpdateIncomeEntitlementEstimate;
use App\Domains\Incomes\Actions\UpdateIncomeNetEstimate;
use App\Domains\Incomes\Models\Income;
use App\Domains\Incomes\Models\IncomeStatistic;
use App\Domains\Shared\Enums\Frequency;
use App\Domains\Users\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Stats\StatsWriter;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // create a test user
        $user = User::factory()->verified()->create([
            'name' => 'Wyatt Castaneda',
            'nickname' => 'Wyatt',
            'email' => 'admin@email.com',
        ]);

        $budget = $user->currentBudget;
    }
}
