<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\BudgetLedger;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ledger = BudgetLedger::factory()->create();

        return [
            'ledger_id' => $ledger->id,
            'from_account_id' => Account::factory()->forBudget($ledger->budget),
            'to_account_id' => Account::factory()->forBudget($ledger->budget),
            'type' => array_rand([
                'transfer' => 'transfer',
                'income' => 'income',
                'expense' => 'expense',
            ]),
            'amount' => random_int(1, 10_000),
            'currency' => 'USD',
            'title' => $this->faker->sentence,
            'description' => rand(0, 1) ? $this->faker->paragraph : null,
            'date' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
