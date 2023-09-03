<?php

use App\Models\Account;
use App\Models\AssetAccountType;
use App\Models\IncomeType;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

use function Pest\Laravel\get;

// test a new workflow
test('new workflow', function () {

    // 1. I am user, I want to create an account
    get(route('register'))->assertStatus(200);

    // 2. I magically create an account
    $user = User::factory()->create();

    // 3. I want to login, so I can use the app
    get(route('login'))->assertStatus(200);

    // 4. I magically login
    /** @var Authenticatable $user */
    auth()->login($user);

    // 5. I want to see my dashboard
    get(route('app.index'))->assertStatus(200);

    // 6. I want to add a new income
    get(route('app.incomes.create'))->assertStatus(200);

    // 7. I magically create an income
    $income = Account::factory()->income()->create([
        'name' => 'Salary',
        'subtype_id' => IncomeType::where('name', 'Salary')->first()->id,
        'budget_id' => currentBudget()->id,
    ]);

    // 8. I want to see my income
    get(route('app.incomes.show', $income))->assertStatus(200);

    // 9. I want to see my incomes
    get(route('app.incomes.index'))->assertStatus(200);

    // 10. I want to create an account for my checking account
    get(route('app.accounts.create'))->assertStatus(200);

    // 11. I magically create an account
    $account = Account::factory()->asset()->create([
        'name' => 'Checking Account',
        'subtype_id' => AssetAccountType::where('name', 'Checking')->first()->id,
        'budget_id' => currentBudget()->id,
    ]);

    // 12. I want to see my account
    get(route('app.accounts.show', $account))->assertStatus(200);

    // 13. I want to see my accounts
    get(route('app.accounts.index'))->assertStatus(200);

    // 14. I want to create a transaction for my income, where I deposit it into my account
    get(route('app.transactions.create'))->assertStatus(200);

    // 15. I magically create a transaction
    $transaction = Transaction::factory()->from($income)->to($account)->create([
        'ledger_id' => currentBudget()->ledger->id,
        'amount' => 1000, // $10.00
        'date' => now()->startOfMonth(),
    ]);

    // todo, i need to add additional details to the transaction
    // such as which the type of debit or credit for each account

    // 16. The transaction should be logged in my budget's ledger
    expect(currentBudget()->ledger->transactions()->count())->toBe(1);
});
