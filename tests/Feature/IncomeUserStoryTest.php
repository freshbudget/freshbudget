<?php

use App\Domains\Incomes\Models\Income;
use App\Domains\Incomes\Models\IncomeFrequency;
use App\Domains\Incomes\Models\IncomeType;
use App\Domains\Users\Models\User;

// test a user story related to incomes
test('a user can create an income', function () {
    // Given I am a user who is logged in
    $user = User::factory()->create();
    $this->actingAs($user);

    // And I have a budget
    $budget = $user->personalBudget();

    // when i create an income
    $income = Income::factory()
        ->for($budget)
        ->ownedBy($user)
        ->withType(IncomeType::where('name', 'Salary')->first())
        ->withFrequency(IncomeFrequency::where('name', 'Monthly')->first())
        ->withAmount(1000)
        ->withStartDate(now()->subWeek())
        ->withEndDate(now()->addYear()->subWeek())
        ->create();

    expect($budget->incomes()->count())->toBe(1);
});
