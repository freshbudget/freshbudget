<?php

use App\Domains\Accounts\Models\Account;
use App\Domains\Incomes\Models\IncomeEntitlement;
use Mpociot\Versionable\VersionableTrait;

test('when model is created, a ulid is generated', function () {
    $model = IncomeEntitlement::factory()->create();

    expect($model->ulid)->not()->toBeNull();
    expect($model->ulid)->toBeString();
    expect(str()->isUlid($model->ulid))->toBeTrue();
});

// test the route key name is ulid
test('the route key name is ulid', function () {
    $model = IncomeEntitlement::factory()->create();

    expect($model->getRouteKeyName())->toBe('ulid');
});

test('the model belongs to a income account', function () {
    $model = IncomeEntitlement::factory()->create();

    expect($model->income)->toBeInstanceOf(Account::class);
});

// test it implements the versionable trait
test('it implements the versionable trait', function () {
    $model = IncomeEntitlement::factory()->create();

    expect(class_uses($model))->toContain(VersionableTrait::class);
});
