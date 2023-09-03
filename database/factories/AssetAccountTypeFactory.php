<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AssetAccountType>
 */
class AssetAccountTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'abbr' => $this->faker->word,
            'tagline' => $this->faker->sentence,
            'description' => $this->faker->text,
            'type' => $this->faker->randomElement(['current', 'long']),
        ];
    }

    public function current(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 'current',
            ];
        });
    }

    public function long(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 'long',
            ];
        });
    }
}
