<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'nickname' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => 'password',
            'two_factor_enabled' => false,
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'two_factor_confirmed_at' => null,
            'current_budget_id' => null,
            'finished_onboarding' => false,
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Indicate that the model has a verified email address.
     */
    public function verified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => now(),
        ]);
    }

    public function onboarded(): static
    {
        return $this->state(fn (array $attributes) => [
            'finished_onboarding' => true,
        ]);
    }

    public function needsOnboarding(): static
    {
        return $this->state(fn (array $attributes) => [
            'finished_onboarding' => false,
        ]);
    }

    /**
     * Indicate that the model has two factor authentication enabled.
     */
    public function withTwoFactorAuth(): static
    {
        return $this->state(fn (array $attributes) => [
            'two_factor_enabled' => true,
            'two_factor_confirmed_at' => now(),
        ]);
    }
}
