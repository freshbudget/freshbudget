<?php

use App\Domains\Accounts\Models\Account;
use App\Domains\Incomes\Models\Income;
use App\Domains\Shared\Enums\AccountType;

// the income model extends the account model
test('the income model extends the account model', function () {
    $income = Account::factory()->income()->create();

    expect($income)->toBeInstanceOf(Account::class);
});

// the income model has a global scope to only show income accounts
test('the income model has a global scope to only show income accounts', function () {
    Account::factory()->count(5)->create([
        'type' => AccountType::EXPENSE,
    ]);

    Account::factory()->count(2)->create([
        'type' => AccountType::REVENUE,
    ]);

    expect(Income::all())->toHaveCount(2);
});
