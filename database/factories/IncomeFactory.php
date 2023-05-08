<?php

namespace Database\Factories;

use App\Models\Budget;
use App\Models\Income;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class IncomeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Income::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'ulid' => $this->faker->word,
            'budget_id' => Budget::factory(),
            'user_id' => User::factory(),
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'url' => $this->faker->url,
            'username' => $this->faker->userName,
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'amount' => $this->faker->numberBetween(-10000, 10000),
            'currency' => $this->faker->word,
            'meta' => '{}',
        ];
    }
}
