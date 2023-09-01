<?php

namespace Database\Factories;

use App\Domains\Accounts\Models\Account;
use App\Domains\Budgets\Models\Budget;
use App\Domains\Incomes\Models\IncomeType;
use App\Domains\Shared\Enums\AccountType;
use App\Domains\Shared\Models\Institute;
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
            'budget_id' => Budget::factory()->create()->id,
            'user_id' => null,
            'name' => $this->faker->name,
            'description' => null,
            'type' => AccountType::REVENUE,
            'subtype_id' => IncomeType::inRandomOrder()->first()->id,
            'currency' => 'USD',
            'frequency' => null,
            'url' => $this->faker->url,
            'username' => null,
            'institution_id' => Institute::factory(),
            'color' => null,
            'meta' => null,
            'active' => true,
            'ledger_id' => null,
        ];
    }

    public function income(): self
    {
        return $this->state([
            'type' => AccountType::REVENUE,
            'subtype_id' => IncomeType::inRandomOrder()->first()->id,
        ]);
    }
}
