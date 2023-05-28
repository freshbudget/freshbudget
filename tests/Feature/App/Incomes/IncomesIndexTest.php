<?php

use App\Domains\Incomes\Models\Income;
use App\Domains\Users\Models\User;

// test the incomes index page is not accessible by a guest but is accessible by a logged in user
test('incomes index page is not accessible to guests, only authenticated users', function () {
    $response = $this->get(route('app.incomes.index'));
    $response->assertStatus(302);
    $response->assertRedirect(route('login'));

    $user = User::factory()->create();
    $response = $this->actingAs($user)->get(route('app.incomes.index'));
    $response->assertStatus(200);
});

// test the user can see all their active incomes
test('user can see all their active incomes', function () {
    $user = User::factory()->create();

    $incomes = Income::factory()->count(3)->active()->create([
        'budget_id' => $user->currentBudget->id,
    ]);

    $response = $this->actingAs($user)->get(route('app.incomes.index'));

    // assert view contains all incomes
    foreach ($incomes as $income) {
        $response->assertSee($income->name);
    }

    // assert view does not contain inactive incomes
    $inactiveIncome = Income::factory()->inactive()->create([
        'budget_id' => $user->currentBudget->id,
    ]);

    $response->assertDontSee($inactiveIncome->name);
});
