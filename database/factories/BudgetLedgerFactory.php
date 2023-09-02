<?php

namespace Database\Factories;

use App\Domains\Budgets\Models\Budget;
use App\Domains\Budgets\Models\BudgetLedger;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\BudgetLedger>
 */
class BudgetLedgerFactory extends Factory
{
    protected $model = BudgetLedger::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'budget_id' => Budget::factory(),
        ];
    }
}
