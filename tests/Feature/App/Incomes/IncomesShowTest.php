<?php

use App\Domains\Incomes\Models\Income;
use App\Domains\Users\Models\User;

// test the incomes index page is not accessible by a guest but is accessible by a logged in user
test('incomes show page is not accessible to guests, only authenticated users', function () {

    $user = User::factory()->create();

    $income = Income::factory()->create([
        'budget_id' => $user->currentBudget->id,
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

    $income = Income::factory()->create([
        'budget_id' => $user->currentBudget->id,
    ]);

    $response = $this->actingAs($user)->get(route('app.incomes.show', $income));

    $response->assertSee($income->name);
});
