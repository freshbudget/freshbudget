<?php

namespace Database\Factories;

use App\Domains\Budgets\Models\Budget;
use App\Domains\Incomes\Models\Income;
use App\Domains\Incomes\Models\IncomeType;
use App\Domains\Shared\Enums\Frequency as FrequencyEnum;
use App\Domains\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class IncomeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Income::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'budget_id' => Budget::factory(),
            'user_id' => User::factory(),
            'name' => $this->faker->company,
            'description' => $this->faker->text,
            'type_id' => IncomeType::factory(),
            'url' => $this->faker->url,
            'username' => $this->faker->userName,
            'currency' => null,
            'frequency' => FrequencyEnum::MONTHLY,
            'meta' => null,
            'active' => true,
            'estimated_entitlements_per_period' => 0,
            'estimated_taxes_per_period' => 0,
            'estimated_deductions_per_period' => 0,
        ];
    }

    /**
     * Indicate the income is active.
     */
    public function active(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'active' => true,
            ];
        });
    }

    /**
     * Indicate the income is inactive.
     */
    public function inactive(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'active' => false,
            ];
        });
    }

    /**
     * Indicate the budget that owns the income.
     */
    public function ownedByBudget(Budget $budget): self
    {
        return $this->state(function (array $attributes) use ($budget) {
            return [
                'budget_id' => $budget->id,
            ];
        });
    }

    /**
     * Indicate the user that owns the income.
     */
    public function ownedBy(User $user): self
    {
        return $this->state(function (array $attributes) use ($user) {
            return [
                'user_id' => $user->id,
            ];
        });
    }

    /**
     * Indicate the type of income.
     */
    public function withType(IncomeType $type): self
    {
        return $this->state(function (array $attributes) use ($type) {
            return [
                'type_id' => $type->id,
            ];
        });
    }

    /**
     * Indicate the income frequency.
     */
    public function withFrequency(FrequencyEnum $frequency): self
    {
        return $this->state(function (array $attributes) use ($frequency) {
            return [
                'frequency' => $frequency->value,
            ];
        });
    }

    /**
     * Indicate that the income has a different currency.
     */
    public function withCurrency(string $currency): self
    {
        return $this->state(function (array $attributes) use ($currency) {
            return [
                'currency' => $currency,
            ];
        });
    }

    /**
     * Indicate the income's meta.
     */
    public function withMeta(array $meta): self
    {
        return $this->state(function (array $attributes) use ($meta) {
            return [
                'meta' => json_encode($meta),
            ];
        });
    }
}
