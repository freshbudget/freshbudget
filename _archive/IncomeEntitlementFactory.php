<?php

namespace Database\Factories;

use App\Domains\Incomes\Models\Income;
use App\Domains\Incomes\Models\IncomeEntitlement;
use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

class IncomeEntitlementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = IncomeEntitlement::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-1 year', '+1 year');
        $endDate = $this->faker->dateTimeBetween($startDate, '+3 year');

        return [
            'account_id' => Account::factory(),
            'name' => $this->faker->name,
            'amount' => $this->faker->numberBetween(0, 10000),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'active' => true,
        ];
    }

    /**
     * Indicate that the income entitlement belongs to the given income.
     */
    public function forIncome(Income $income): Factory
    {
        return $this->state(function (array $attributes) use ($income) {
            return [
                'account_id' => $income->id,
            ];
        });
    }

    /**
     * Indicate the amount of the income entitlement.
     */
    public function amount(int $amount): Factory
    {
        return $this->state(function (array $attributes) use ($amount) {
            return [
                'amount' => $amount,
            ];
        });
    }

    /**
     * Indicate the start date of the income entitlement.
     */
    public function startDate(string $startDate): Factory
    {
        return $this->state(function (array $attributes) use ($startDate) {
            return [
                'start_date' => $startDate,
            ];
        });
    }

    /**
     * Indicate the end date of the income entitlement.
     */
    public function endDate(string $endDate): Factory
    {
        return $this->state(function (array $attributes) use ($endDate) {
            return [
                'end_date' => $endDate,
            ];
        });
    }
}
