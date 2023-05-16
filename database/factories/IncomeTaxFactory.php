<?php

namespace Database\Factories;

use App\Domains\Incomes\Models\Income;
use App\Domains\Incomes\Models\IncomeTax;
use Illuminate\Database\Eloquent\Factories\Factory;

class IncomeTaxFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = IncomeTax::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-1 year', '+1 year');
        $endDate = $this->faker->dateTimeBetween($startDate, '+3 year');

        return [
            'income_id' => Income::factory(),
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'amount' => $this->faker->numberBetween(0, 10000),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'previous_id' => null,
            'change_reason' => null,
            'active' => $this->faker->boolean,
        ];
    }

    /**
     * Indicate that the income tax belongs to the given income.
     */
    public function forIncome(Income $income): Factory
    {
        return $this->state(function (array $attributes) use ($income) {
            return [
                'income_id' => $income->id,
            ];
        });
    }

    /**
     * Indicate the amount of the income tax.
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
     * Indicate the start date of the income tax.
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
     * Indicate the end date of the income tax.
     */
    public function endDate(string $endDate): Factory
    {
        return $this->state(function (array $attributes) use ($endDate) {
            return [
                'end_date' => $endDate,
            ];
        });
    }

    /**
     * Indicate the previous income tax.
     */
    public function previous(IncomeTax $previous): Factory
    {
        return $this->state(function (array $attributes) use ($previous) {
            return [
                'previous_id' => $previous->id,
            ];
        });
    }

    /**
     * Indicate the change reason of the income tax.
     */
    public function changeReason(string $changeReason): Factory
    {
        return $this->state(function (array $attributes) use ($changeReason) {
            return [
                'change_reason' => $changeReason,
            ];
        });
    }

    /**
     * Indicate that the income tax is active.
     */
    public function active(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'active' => true,
            ];
        });
    }

    /**
     * Indicate that the income tax is inactive.
     */
    public function inactive(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'active' => false,
            ];
        });
    }    
}
