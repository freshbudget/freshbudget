<?php

namespace Database\Factories;

use App\Domains\Shared\Models\Institute;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Institute>
 */
class InstituteFactory extends Factory
{
    protected $model = Institute::class;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'abbr' => $this->faker->unique()->word,
            'color' => $this->faker->hexColor,
            'description' => $this->faker->paragraph,
            'general_url' => $this->faker->url,
            'auth_url' => $this->faker->url,
            'active' => $this->faker->boolean,
        ];
    }
}
