<?php

namespace Database\Factories;

use App\Domains\Incomes\Models\Income;
use App\Domains\Incomes\Models\IncomeStatistic;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory
 */
class IncomeStatisticFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected string $model = IncomeStatistic::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'income_id' => Income::factory(),
            'name' => $this->faker->name,
            'type' => 'set',
            'value' => random_int(0, 1000000),
        ];
    }
}
