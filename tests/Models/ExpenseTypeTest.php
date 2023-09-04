<?php

use App\Models\ExpenseType;

test('when model is created, a ulid is generated', function () {
    $model = ExpenseType::factory()->create();

    expect($model->ulid)->not()->toBeNull();
    expect($model->ulid)->toBeString();
    expect(str()->isUlid($model->ulid))->toBeTrue();
});

// test the route key name is ulid
test('the route key name is ulid', function () {
    $model = ExpenseType::factory()->create();

    expect($model->getRouteKeyName())->toBe('ulid');
});
