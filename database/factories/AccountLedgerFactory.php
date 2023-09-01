<?php

namespace Database\Factories;

use App\Domains\Accounts\Models\Account;
use App\Domains\Accounts\Models\AccountLedger;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\AccountLedger>
 */
class AccountLedgerFactory extends Factory
{
    protected $model = AccountLedger::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'account_id' => Account::factory(),
        ];
    }
}
