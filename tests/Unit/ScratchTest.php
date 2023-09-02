<?php

use App\Domains\Accounts\Models\Account;
use App\Domains\Users\Models\User;
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
        'budget_id' => currentBudget()->id,
    ]);

    // 8. I want to see my income
    get(route('app.incomes.show', $income))->assertStatus(200);
});
