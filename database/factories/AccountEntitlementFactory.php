<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AccountEntitlement>
 */
class AccountEntitlementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ulid' => null,
            'account_id' => null,
            'account_type' => null,
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'amount' => $this->faker->random_int(0, 500000),
            'start_date' => $start = $this->faker->date(),
            'end_date' => $this->faker->dateTimeBetween($start, '+1 year'),
            'active' => $this->faker->boolean(80),
        ];
    }
}
