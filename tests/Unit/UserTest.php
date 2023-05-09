<?php

use App\Domains\Budgets\Models\Budget;
use App\Domains\Users\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;

// test when a model is created, a ulid is generated
test('when model is created, a ulid is generated', function () {
    $model = User::factory()->create();

    expect($model->ulid)->not()->toBeNull();
    expect($model->ulid)->toBeString();
    expect(str()->isUlid($model->ulid))->toBeTrue();
});

// test the password is hashed when set
test('the password is hashed when set', function () {
    $model = User::factory()->create([
        'password' => 'password',
    ]);

    expect($model->password)->not()->toBe('password');
    expect($model->password)->not()->toBeNull();
    expect($model->password)->toBeString();
});

// test the route key name is ulid
test('the route key name is ulid', function () {
    $model = User::factory()->create();

    expect($model->getRouteKeyName())->toBe('ulid');
});

// test the user implements MustVerifyEmail
test('the user implements MustVerifyEmail', function () {
    $model = User::factory()->create();

    expect($model)->toBeInstanceOf(MustVerifyEmail::class);
});

// test that when a user is created, a personal budget is created for them
test('when a user is created, a personal budget is created for them', function () {
    $user = User::factory()->create();

    // Assert
    expect($user->ownedBudgets->count())->toBe(1);
    expect($user->personalBudget())->toBeInstanceOf(Budget::class);
    expect($user->personalBudget()->owner->is($user))->toBeTrue();
    expect($user->personalBudget()->name)->toBe('Personal Budget');
});

// test is can check if it belongs to a budget
test('it can check if it belongs to a budget', function () {
    $user = User::factory()->create();
    $budget = Budget::factory()->create();

    // Assert
    expect($user->belongsToBudget($budget))->toBeFalse();
    expect($user->belongsToBudget($user->personalBudget()))->toBeTrue();
});

// test it can retieve the current budget for the user
test('it can retieve the current budget for the user', function () {
    $user = User::factory()->create();
    $budget = Budget::factory()->create();

    expect($user->currentBudget)->toBeInstanceOf(Budget::class);
    expect($user->currentBudget->is($user->personalBudget()))->toBeTrue();
    expect($user->currentBudget->is($budget))->toBeFalse();
});

// test the current budget defaults to the personal budget
test('the current budget defaults to the personal budget', function () {
    $user = User::factory()->create();

    // manuall set the current budget to null
    $user->current_budget_id = null;
    $user->save();

    expect($user->currentBudget->is($user->personalBudget()))->toBeTrue();
});

// test if can check if the given budget is the current budget
test('it can check if the given budget is the current budget', function () {
    $user = User::factory()->create();
    $budget = Budget::factory()->create();

    expect($user->isCurrentBudget($user->personalBudget()))->toBeTrue();
    expect($user->isCurrentBudget($budget))->toBeFalse();
});

// test it can retrive owned budgets
test('it can retrive owned budgets', function () {
    $user = User::factory()->create();
    $budget = Budget::factory()->create([
        'owner_id' => $user->id,
    ]);

    expect($user->ownedBudgets->count())->toBe(2);
    expect($user->ownedBudgets->contains($budget))->toBeTrue();
});

// test it can check if it owns a budget
test('it can check if it owns a budget', function () {
    $user = User::factory()->create();
    $budget = Budget::factory()->create([
        'owner_id' => $user->id,
    ]);

    // create a budget that the user does not own
    $budget2 = Budget::factory()->create();

    expect($user->ownsBudget($budget))->toBeTrue();
    expect($user->ownsBudget($user->personalBudget()))->toBeTrue();
    expect($user->ownsBudget($budget2))->toBeFalse();
});

// test it can retrieve the personal budget
test('it can retrieve the personal budget', function () {
    $user = User::factory()->create();

    expect($user->personalBudget())->toBeInstanceOf(Budget::class);
    expect($user->personalBudget()->owner->is($user))->toBeTrue();
    expect($user->personalBudget()->name)->toBe('Personal Budget');
});

// test it can switch current budgets
test('it can switch current budgets', function () {
    $user = User::factory()->create();
    $budget = Budget::factory()->create([
        'owner_id' => $user->id,
    ]);

    expect($user->currentBudget->is($user->personalBudget()))->toBeTrue();

    $user->switchCurrentBudget($budget);

    expect($user->isCurrentBudget($budget))->toBeTrue();
});

// test it cannot switch to a budget it does not own
test('it cannot switch to a budget it does not own', function () {
    $user = User::factory()->create();
    $budget = Budget::factory()->create();

    expect($user->currentBudget->is($user->personalBudget()))->toBeTrue();

    $user->switchCurrentBudget($budget);

    expect($user->isCurrentBudget($budget))->toBeFalse();
    expect($user->isCurrentBudget($user->personalBudget()))->toBeTrue();
});