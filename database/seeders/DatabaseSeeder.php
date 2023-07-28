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

        // create a income
        $income = Income::factory()
            ->ownedByBudget($budget)
            ->active()
            ->withFrequency(Frequency::MONTHLY)
            ->create();

        $entitlements = [
            [
                'name' => 'Base',
                'amount' => 1_000,
            ],
            [
                'name' => 'Extra',
                'amount' => 500,
            ],
        ];

        foreach ($entitlements as $entitlement) {
            (new CreateIncomeEntitlementAction($income, [
                'name' => $entitlement['name'],
                'amount' => $entitlement['amount'],
            ]))->execute();
        }

        (new UpdateIncomeEntitlementEstimate($income))->execute();

        (new UpdateIncomeNetEstimate($income))->execute();

        StatsWriter::for(IncomeStatistic::class, [
            'income_id' => $income->id,
            'name' => 'estimated_entitlements_per_period',
        ])->set($income->estimated_entitlements_per_period);
    }
}
