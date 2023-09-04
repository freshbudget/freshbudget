<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseTypeFactory extends Factory
{
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
