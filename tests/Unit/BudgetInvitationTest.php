<?php

use App\Domains\Budgets\Models\Budget;
use App\Domains\Budgets\Models\BudgetInvitation;

test('when model is created, a ulid is generated', function () {
    $model = BudgetInvitation::factory()->create();

    expect($model->ulid)->not()->toBeNull();
    expect($model->ulid)->toBeString();
    expect(str()->isUlid($model->ulid))->toBeTrue();
});

// test it has constants for the states
test('it has constants for the states', function () {
    expect(BudgetInvitation::STATE_PENDING)->toBe('pending');
    expect(BudgetInvitation::STATE_EXPIRED)->toBe('expired');
    expect(BudgetInvitation::STATE_ACCEPTED)->toBe('accepted');
    expect(BudgetInvitation::STATE_REJECTED)->toBe('rejected');
});

// test the route key name is ulid
test('the route key name is ulid', function () {
    $model = BudgetInvitation::factory()->create();

    expect($model->getRouteKeyName())->toBe('ulid');
});

// test it can generate a token
test('it can generate a token', function () {
    $model = BudgetInvitation::factory()->create();

    expect($model->token)->not()->toBeNull();
    expect($model->token)->toBeString();
    expect($model->token)->toHaveLength(32);
});

// test it belongs to a budget
test('it belongs to a budget', function () {
    $model = BudgetInvitation::factory()->create();

    expect($model->budget)->toBeInstanceOf(Budget::class);
});

// test the factory can generate a model with an expired state
test('the factory can generate a model with an expired state', function () {
    $model = BudgetInvitation::factory()->expired()->create();

    expect($model->state)->toBe(BudgetInvitation::STATE_EXPIRED);
    expect($model->isExpired())->toBeTrue();
});

// test the factory can generate a model with an accepted state
test('the factory can generate a model with an accepted state', function () {
    $model = BudgetInvitation::factory()->accepted()->create();

    expect($model->state)->toBe(BudgetInvitation::STATE_ACCEPTED);
    expect($model->isAccepted())->toBeTrue();
});

// test the factory can generate a model with a rejected state
test('the factory can generate a model with a rejected state', function () {
    $model = BudgetInvitation::factory()->rejected()->create();

    expect($model->state)->toBe(BudgetInvitation::STATE_REJECTED);
    expect($model->isRejected())->toBeTrue();
});

// test the factory can generate a model with a pending state
test('the factory can generate a model with a pending state', function () {
    $model = BudgetInvitation::factory()->pending()->create();

    expect($model->state)->toBe(BudgetInvitation::STATE_PENDING);
    expect($model->isPending())->toBeTrue();
});