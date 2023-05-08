<?php

namespace Database\Factories;

use App\Domains\Budgets\Models\Budget;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BudgetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Budget::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'currency' => $this->faker->currencyCode(),
            'owner_id' => User::factory(),
        ];
    }
}
