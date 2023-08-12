<?php

use App\Domains\Accounts\Models\Account;
use App\Domains\Incomes\Models\Income;
use App\Domains\Incomes\Models\IncomeType;
use App\Domains\Shared\Enums\AccountType;
use App\Domains\Users\Models\User;

// test the incomes index page is not accessible by a guest but is accessible by a logged in user
test('incomes show page is not accessible to guests, only authenticated users', function () {

    $user = User::factory()->create();

    $income = Account::factory()->create([
        'type' => AccountType::REVENUE,
        'budget_id' => $user->currentBudget->id,
        'subtype_id' => IncomeType::inRandomOrder()->first()->id,
    ]);

    $response = $this->get(route('app.incomes.show', $income));
    $response->assertStatus(302);
    $response->assertRedirect(route('login'));
    $response = $this->actingAs($user)->get(route('app.incomes.show', $income));
    $response->assertStatus(200);
});

// test the user can see the name of the income
test('user can see the name of the income', function () {
    $user = User::factory()->create();

    $income = Account::factory()->create([
        'type' => AccountType::REVENUE,
        'budget_id' => $user->currentBudget->id,
        'subtype_id' => IncomeType::inRandomOrder()->first()->id,
    ]);

    $response = $this->actingAs($user)->get(route('app.incomes.show', $income));

    $response->assertSee($income->name);
});
