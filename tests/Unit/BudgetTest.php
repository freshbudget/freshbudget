<?php

use App\Domains\Budgets\Models\Budget;
use App\Domains\Budgets\Models\BudgetInvitation;
use App\Models\User;

// test when a model is created, a ulid is generated
test('when model is created, a ulid is generated', function () {
    $model = Budget::factory()->create();

    expect($model->ulid)->not()->toBeNull();
    expect($model->ulid)->toBeString();
    expect(str()->isUlid($model->ulid))->toBeTrue();
});

// test the route key name is ulid
test('the route key name is ulid', function () {
    $model = Budget::factory()->create();

    expect($model->getRouteKeyName())->toBe('ulid');
});

// test the model belongs to a user via the owner
test('the model belongs to a user via the owner', function () {
    $model = Budget::factory()->create();

    expect($model->owner)->toBeInstanceOf(User::class);
});

// test it has many invitations
test('it has many invitations', function () {
    $model = Budget::factory()->create();

    // create 3 invitations
    $model->invitations()->createMany(
        BudgetInvitation::factory()->count(3)->make()->toArray()
    );

    expect($model->invitations->count())->toBe(3);
    expect($model->invitations->first())->toBeInstanceOf(BudgetInvitation::class);
});

/// test it belongs to many users via the members
test('it belongs to many users via the members', function () {
    $model = Budget::factory()->create();

    // create 3 users
    $users = User::factory()->count(3)->create();

    // attach the users to the budget
    $model->users()->attach($users);

    expect($model->users->count())->toBe(3);
    expect($model->users->first())->toBeInstanceOf(User::class);
});
