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

        $fromAccount = Account::factory()->income()->forBudget($ledger->budget)->create();
        $toAccount = Account::factory()->asset()->forBudget($ledger->budget)->create();

        return [
            'ledger_id' => $ledger->id,
            'from_account_type' => $fromAccount->getMorphClass(),
            'from_account_id' => $fromAccount->id,
            'to_account_type' => $toAccount->getMorphClass(),
            'to_account_id' => $toAccount->id,
            'type' => array_rand([
                'transfer' => 'transfer',
                'debit' => 'debit',
                'credit' => 'credit',
            ]),
            'amount' => random_int(1, 10_000),
            'currency' => 'USD',
            'title' => $this->faker->sentence,
            'description' => rand(0, 1) ? $this->faker->paragraph : null,
            'date' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }

    public function from(Account $account): self
    {
        return $this->state([
            'from_account_type' => $account->getMorphClass(),
            'from_account_id' => $account->id,
        ]);
    }

    public function to(Account $account): self
    {
        return $this->state([
            'to_account_type' => $account->getMorphClass(),
            'to_account_id' => $account->id,
        ]);
    }
}
