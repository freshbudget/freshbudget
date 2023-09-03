<?php

use App\Models\Budget;
use App\Models\BudgetLedger;

test('when model is created, a ulid is generated', function () {
    $model = BudgetLedger::factory()->create();

    expect($model->ulid)->not()->toBeNull();
    expect($model->ulid)->toBeString();
    expect(str()->isUlid($model->ulid))->toBeTrue();
});

test('the route key name is ulid', function () {
    $model = BudgetLedger::factory()->create();

    expect($model->getRouteKeyName())->toBe('ulid');
});

test('it belongs to a budget', function () {
    $model = BudgetLedger::factory()->create();

    expect($model->budget)->toBeInstanceOf(Budget::class);
});
