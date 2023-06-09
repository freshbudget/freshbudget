<?php

namespace Database\Factories;

use App\Domains\Budgets\Models\BudgetUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class BudgetUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BudgetUser::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            //
        ];
    }
}
