<?php

namespace Database\Factories;

use App\Models\Budget;
use App\Models\BudgetLedger;
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
