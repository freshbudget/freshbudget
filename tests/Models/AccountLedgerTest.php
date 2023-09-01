<?php

use App\Domains\Accounts\Models\Account;
use App\Domains\Accounts\Models\AccountLedger;

test('when model is created, a ulid is generated', function () {
    $model = AccountLedger::factory()->create();

    expect($model->ulid)->not()->toBeNull();
    expect($model->ulid)->toBeString();
    expect(str()->isUlid($model->ulid))->toBeTrue();
});

// test the route key name is ulid
test('the route key name is ulid', function () {
    $model = AccountLedger::factory()->create();

    expect($model->getRouteKeyName())->toBe('ulid');
});

// test it belongs to a account
test('it belongs to a account', function () {
    $model = AccountLedger::factory()->create();

    expect($model->account)->toBeInstanceOf(Account::class);
});
