<?php

namespace Database\Factories;

use App\Enums\AccountType;
use App\Models\Account;
use App\Models\Budget;
use App\Models\IncomeType;
use App\Models\Institute;
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
        ];
    }

    public function income(): self
    {
        return $this->state([
            'type' => AccountType::REVENUE,
            'subtype_id' => IncomeType::inRandomOrder()->first()->id,
        ]);
    }

    public function forBudget(Budget $budget): self
    {
        return $this->state([
            'budget_id' => $budget->id,
        ]);
    }
}
