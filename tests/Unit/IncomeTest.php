<?php

use App\Domains\Budgets\Models\Budget;
use App\Domains\Incomes\Models\Income;
use App\Domains\Incomes\Models\IncomeFrequency;
use App\Domains\Incomes\Models\IncomeType;
use App\Models\User;

test('when model is created, a ulid is generated', function () {
    $model = Income::factory()->create();

    expect($model->ulid)->not()->toBeNull();
    expect($model->ulid)->toBeString();
    expect(str()->isUlid($model->ulid))->toBeTrue();
});

// test the route key name is ulid
test('the route key name is ulid', function () {
    $model = Income::factory()->create();

    expect($model->getRouteKeyName())->toBe('ulid');
});

/// test the model belongs to a budget
test('the model belongs to a budget', function () {
    $model = Income::factory()->create();

    expect($model->budget)->toBeInstanceOf(Budget::class);
});

// test the model belongs to an income frequency
test('the model belongs to an income frequency', function () {
    $model = Income::factory()->create();

    expect($model->frequency)->toBeInstanceOf(IncomeFrequency::class);
});

// the the model belongs to an income type
test('the model belongs to an income type, optionally', function () {
    $model = Income::factory()->create();

    expect($model->type)->toBeInstanceOf(IncomeType::class);
});

// test the model belongs to a user, optionally
test('the model belongs to a user via the owner, optionally', function () {
    $model = Income::factory()->create([
        'user_id' => User::factory(),
    ]);

    expect($model->user)->toBeInstanceOf(User::class);
});
