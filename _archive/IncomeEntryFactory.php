<?php

namespace Database\Factories;

use App\Domains\Incomes\Models\Income;
use App\Domains\Incomes\Models\IncomeEntry;
use Illuminate\Database\Eloquent\Factories\Factory;

class IncomeEntryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = IncomeEntry::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'income_id' => Income::factory(),
            'date' => $this->faker->date(),
            'entitlements' => '{}',
            'taxes' => '{}',
            'deductions' => '{}',
            'entitlements_total' => $this->faker->numberBetween(0, 10000),
            'taxes_total' => $this->faker->numberBetween(0, 10000),
            'deductions_total' => $this->faker->numberBetween(0, 10000),
            'net_income' => $this->faker->numberBetween(0, 10000),
        ];
    }

    /**
     * Indicate that the income entry belongs to the given income.
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
     * Indicate the date of the income entry.
     */
    public function date(string $date): Factory
    {
        return $this->state(function (array $attributes) use ($date) {
            return [
                'date' => $date,
            ];
        });
    }

    /**
     * Indicate the entitlements of the income entry.
     */
    public function entitlements(array $entitlements): Factory
    {
        // TODO: do i need to cast this to json? json_encode($entitlements)?
        return $this->state(function (array $attributes) use ($entitlements) {
            return [
                'entitlements' => $entitlements,
            ];
        });
    }

    /**
     * Indicate the taxes of the income entry.
     */
    public function taxes(array $taxes): Factory
    {
        return $this->state(function (array $attributes) use ($taxes) {
            return [
                'taxes' => $taxes,
            ];
        });
    }

    /**
     * Indicate the deductions of the income entry.
     */
    public function deductions(array $deductions): Factory
    {
        return $this->state(function (array $attributes) use ($deductions) {
            return [
                'deductions' => $deductions,
            ];
        });
    }

    /**
     * Indicate the entitlements total of the income entry.
     */
    public function entitlementsTotal(int $entitlementsTotal): Factory
    {
        return $this->state(function (array $attributes) use ($entitlementsTotal) {
            return [
                'entitlements_total' => $entitlementsTotal,
            ];
        });
    }

    /**
     * Indicate the taxes total of the income entry.
     */
    public function taxesTotal(int $taxesTotal): Factory
    {
        return $this->state(function (array $attributes) use ($taxesTotal) {
            return [
                'taxes_total' => $taxesTotal,
            ];
        });
    }

    /**
     * Indicate the deductions total of the income entry.
     */
    public function deductionsTotal(int $deductionsTotal): Factory
    {
        return $this->state(function (array $attributes) use ($deductionsTotal) {
            return [
                'deductions_total' => $deductionsTotal,
            ];
        });
    }

    /**
     * Indicate the net income of the income entry.
     */
    public function netIncome(int $netIncome): Factory
    {
        return $this->state(function (array $attributes) use ($netIncome) {
            return [
                'net_income' => $netIncome,
            ];
        });
    }
}
