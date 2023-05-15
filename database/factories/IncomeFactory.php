<?php

namespace Database\Factories;

use App\Domains\Budgets\Models\Budget;
use App\Domains\Incomes\Models\Income;
use App\Domains\Incomes\Models\IncomeFrequency;
use App\Domains\Incomes\Models\IncomeType;
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
            'start_date' => $this->faker->dateTimeBetween('now-1year', 'now'),
            'end_date' => null,
            'currency' => null,
            'frequency_id' => IncomeFrequency::factory(),
            'meta' => null,
        ];
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
    public function withFrequency(IncomeFrequency $frequency): self
    {
        return $this->state(function (array $attributes) use ($frequency) {
            return [
                'frequency_id' => $frequency->id,
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
     * Indicate the income's start date.
     */
    public function withStartDate(string $startDate): self
    {
        return $this->state(function (array $attributes) use ($startDate) {
            return [
                'start_date' => $startDate,
            ];
        });
    }

    /**
     * Indicate the income's end date.
     */
    public function withEndDate(string $endDate): self
    {
        return $this->state(function (array $attributes) use ($endDate) {
            return [
                'end_date' => $endDate,
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
