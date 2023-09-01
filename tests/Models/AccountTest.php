<?php

use App\Domains\Accounts\Events\AccountCreated;
use App\Domains\Accounts\Events\AccountDeleted;
use App\Domains\Accounts\Models\Account;
use App\Domains\Budgets\Models\Budget;
use App\Domains\Incomes\Models\Income;
use App\Domains\Shared\Enums\AccountType;
use App\Domains\Shared\Enums\Currency;
use App\Domains\Shared\Enums\Frequency;
use App\Domains\Shared\Models\Institute;
use App\Domains\Users\Models\User;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\SoftDeletes;

test('when model is created, a ulid is generated', function () {
    $model = Account::factory()->create();

    expect($model->ulid)->not()->toBeNull();
    expect($model->ulid)->toBeString();
    expect(str()->isUlid($model->ulid))->toBeTrue();
});

// test the route key name is ulid
test('the route key name is ulid', function () {
    $model = Account::factory()->create();

    expect($model->getRouteKeyName())->toBe('ulid');
});

// test it dispatches the AccountCreated event when created
test('it dispatches the AccountCreated event when created', function () {
    Event::fake([
        AccountCreated::class,
    ]);

    $model = Account::factory()->create();

    Event::assertDispatched(AccountCreated::class, function ($event) use ($model) {
        return $event->account->is($model);
    });
});

// test it dispatches the AccountDeleted event when deleted
test('it dispatches the AccountDeleted event when deleted', function () {
    Event::fake([
        AccountDeleted::class,
    ]);

    $model = Account::factory()->create();

    $model->delete();

    Event::assertDispatched(AccountDeleted::class, function ($event) use ($model) {
        return $event->account->is($model);
    });
});

// it can be scoped to active accounts
test('it can be scoped to active accounts', function () {
    Account::factory()->create([
        'active' => true,
    ]);

    Account::factory()->create([
        'active' => false,
    ]);

    expect(Account::active()->get())->toHaveCount(1);
});

// test it belongs to a budget
test('it belongs to a budget', function () {
    $model = Account::factory()->create();

    expect($model->budget)->toBeInstanceOf(Budget::class);
});

// test it can belong to a user
test('it can belong to a user', function () {
    $model = Account::factory()->create([
        'user_id' => User::factory()->create(),
    ]);

    expect($model->user)->toBeInstanceOf(User::class);
});

// test it can belong to an institution
test('it can belong to an institution', function () {
    $model = Account::factory()->create([
        'institution_id' => Institute::factory()->create(),
    ]);

    expect($model->institution)->toBeInstanceOf(Institute::class);
});

// test the type is an enum
test('the type is an enum', function () {
    $model = Account::factory()->create([
        'type' => AccountType::REVENUE,
    ]);

    expect($model->type)->toBe(AccountType::REVENUE);
});

// the currency is an enum
test('the currency is an enum', function () {
    $model = Account::factory()->create([
        'currency' => Currency::USD,
    ]);

    expect($model->currency)->toBe(Currency::USD);
});

// the frequency is an enum
test('the frequency is an enum', function () {
    $model = Account::factory()->create([
        'frequency' => Frequency::MONTHLY,
    ]);

    expect($model->frequency)->toBe(Frequency::MONTHLY);
});

// it has the prunable trait
test('it has the prunable trait', function () {
    $model = Account::factory()->create();

    expect(class_uses_recursive($model))->toContain(Prunable::class);
});

// it has the soft deletes trait
test('it has the soft deletes trait', function () {
    $model = Account::factory()->create();

    expect(class_uses_recursive($model))->toContain(SoftDeletes::class);
});
