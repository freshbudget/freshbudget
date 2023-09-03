<?php

use App\Models\Budget;
use App\Models\BudgetLedger;
use App\Models\Transaction;

test('when model is created, a ulid is generated', function () {
    $model = Transaction::factory()->create();

    expect($model->ulid)->not()->toBeNull();
    expect($model->ulid)->toBeString();
    expect(str()->isUlid($model->ulid))->toBeTrue();
});

test('the route key name is ulid', function () {
    $model = Transaction::factory()->create();

    expect($model->getRouteKeyName())->toBe('ulid');
});

test('it belongs to a ledger', function () {
    $model = Transaction::factory()->create();

    expect($model->ledger)->toBeInstanceOf(BudgetLedger::class);
});

// test it can access the budget through the ledger
test('it can access the budget through the ledger', function () {
    $model = Transaction::factory()->create();

    expect($model->budget())->toBeInstanceOf(Budget::class);
});
