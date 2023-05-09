<?php

namespace Database\Factories;

use App\Domains\Incomes\Models\IncomeType;
use Illuminate\Database\Eloquent\Factories\Factory;

class IncomeTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = IncomeType::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'abbr' => $this->faker->word,
            'tagline' => $this->faker->sentence,
            'description' => $this->faker->text,
        ];
    }
}
