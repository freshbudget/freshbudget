<?php

namespace Database\Factories;

use App\Domains\Budgets\Models\BudgetStatistic;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\BudgetStatistic>
 */
class BudgetStatisticFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = BudgetStatistic::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
        ];
    }
}
