<?php

use App\Domains\Budgets\Events\BudgetCreated;
use App\Domains\Budgets\Events\BudgetDeleted;
use App\Domains\Budgets\Models\Budget;
use App\Domains\Budgets\Models\BudgetInvitation;
use App\Domains\Incomes\Models\Income;
use App\Domains\Users\Models\User;
use Illuminate\Support\Facades\Event;

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

    // should be 4 users (3 created + 1 owner)
    expect($model->users->count())->toBe(4);
    expect($model->users->first())->toBeInstanceOf(User::class);
});

// test an event is dispatched when a budget is created
test('an event is dispatched when a budget is created', function () {
    Event::fake([
        BudgetCreated::class,
    ]);

    $model = Budget::factory()->create();

    Event::assertDispatched(BudgetCreated::class, function ($event) use ($model) {
        return $event->budget->is($model);
    });
});

// test it can check if a user is a member
test('it can check if a user is a member', function () {
    $budget = Budget::factory()->create();

    // create 1 users
    $user = User::factory()->create();

    // check if the owner is a member
    expect($budget->hasUser($budget->owner))->toBeTrue();

    // check if the first user is a member
    expect($budget->hasUser($user))->toBeFalse();
});

// test it can check if a user is an owner
test('it can check if a user is an owner', function () {
    $budget = Budget::factory()->create();

    // create 1 users
    $user = User::factory()->create();

    // check if the owner is an owner
    expect($budget->isOwnedBy($budget->owner))->toBeTrue();

    // check if the first user is an owner
    expect($budget->isOwnedBy($user))->toBeFalse();
});

// test it can check if a user exists with a given email
test('it can check if a user exists with a given email', function () {
    $budget = Budget::factory()->create();

    // create 1 users
    $user = User::factory()->create();

    // check if the owner is an owner
    expect($budget->hasUserWithEmail($budget->owner->email))->toBeTrue();

    // check if the first user is an owner
    expect($budget->hasUserWithEmail($user->email))->toBeFalse();
});

// test it has many incomes
test('it has many incomes', function () {
    $model = Budget::factory()->create();

    // create 3 incomes
    $model->incomes()->createMany(
        Income::factory()->count(3)->make()->toArray()
    );

    expect($model->incomes->count())->toBe(3);
    expect($model->incomes->first())->toBeInstanceOf(Income::class);
});

// test when a budget is deleting, an event is dispatched
test('when a budget is deleting, an event is dispatched', function () {
    Event::fake([
        BudgetDeleted::class,
    ]);

    $model = Budget::factory()->create();

    $model->delete();

    Event::assertDispatched(BudgetDeleted::class, function ($event) use ($model) {
        return $event->budget->is($model);
    });
});

// test it can add a user
test('it can add a user', function () {
    $budget = Budget::factory()->create();

    // create 1 users
    $user = User::factory()->create();

    // add the user
    $budget->addUser($user);

    // check if the user is a member
    expect($budget->hasUser($user))->toBeTrue();
});
