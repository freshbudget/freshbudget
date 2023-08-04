<?php

namespace Database\Factories;

use App\Domains\Accounts\Models\Account;
use App\Domains\Budgets\Models\Budget;
use App\Domains\Shared\Enums\AccountType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Account>
 */
class AccountFactory extends Factory
{
    protected $model = Account::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'budget_id' => Budget::factory(),
            'user_id' => null,
            'name' => $this->faker->name,
            'description' => null,
            'type' => AccountType::ASSET,
            'currency' => 'USD',
            'frequency' => null,
            'url' => $this->faker->url,
            'username' => null,
            'institution' => null,
            'color' => null,
            'meta' => null,
            'active' => true,
        ];
    }
}
