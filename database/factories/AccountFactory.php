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
            'name' => $this->faker->name,
            'budget_id' => Budget::factory(),
            'user_id' => null,
            'type' => AccountType::ASSET,
            'active' => true,
            'currency' => 'USD',
        ];
    }
}
