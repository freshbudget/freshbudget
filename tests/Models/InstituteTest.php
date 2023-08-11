<?php

use App\Domains\Shared\Models\Institute;

test('when model is created, a ulid is generated', function () {
    $model = Institute::factory()->create();

    expect($model->ulid)->not()->toBeNull();
    expect($model->ulid)->toBeString();
    expect(str()->isUlid($model->ulid))->toBeTrue();
});

// test the route key name is ulid
test('the route key name is ulid', function () {
    $model = Institute::factory()->create();

    expect($model->getRouteKeyName())->toBe('ulid');
});
