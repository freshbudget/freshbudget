<?php

namespace Database\Factories;

use App\Domains\Incomes\Models\IncomeFrequency;
use Illuminate\Database\Eloquent\Factories\Factory;

class IncomeFrequencyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = IncomeFrequency::class;

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
