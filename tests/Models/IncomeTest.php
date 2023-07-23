<?php

use App\Domains\Budgets\Models\Budget;
use App\Domains\Incomes\Models\Income;
use App\Domains\Incomes\Models\IncomeDeduction;
use App\Domains\Incomes\Models\IncomeEntitlement;
use App\Domains\Incomes\Models\IncomeTax;
use App\Domains\Incomes\Models\IncomeType;
use App\Domains\Shared\Enums\Frequency;
use App\Domains\Users\Models\User;

test('when model is created, a ulid is generated', function () {
    $model = Income::factory()->create();

    expect($model->ulid)->not()->toBeNull();
    expect($model->ulid)->toBeString();
    expect(str()->isUlid($model->ulid))->toBeTrue();
});

// test the route key name is ulid
test('the route key name is ulid', function () {
    $model = Income::factory()->create();

    expect($model->getRouteKeyName())->toBe('ulid');
});

/// test the model belongs to a budget
test('the model belongs to a budget', function () {
    $model = Income::factory()->create();

    expect($model->budget)->toBeInstanceOf(Budget::class);
});

// the the model belongs to an income type
test('the model belongs to an income type, optionally', function () {
    $model = Income::factory()->create();

    expect($model->type)->toBeInstanceOf(IncomeType::class);
});

// test the model belongs to a user, optionally
test('the model belongs to a user via the owner, optionally', function () {
    $model = Income::factory()->create([
        'user_id' => User::factory(),
    ]);

    expect($model->user)->toBeInstanceOf(User::class);
});

// test an income can have many entitlements
test('an income can have many entitlements', function () {
    $model = Income::factory()->create();

    $entitlement = $model->entitlements()->create([
        'name' => 'Test Entitlement',
        'amount' => 100,
        'active' => true,
    ]);

    expect($model->entitlements->count())->toBe(1);
    expect($model->entitlements->first())->toBeInstanceOf(IncomeEntitlement::class);
});

// test an income can have many deductions
test('an income can have many deductions', function () {
    $model = Income::factory()->create();

    $deduction = $model->deductions()->create([
        'name' => 'Test Deduction',
        'amount' => 100,
        'active' => true,
    ]);

    expect($model->deductions->count())->toBe(1);
    expect($model->deductions->first())->toBeInstanceOf(IncomeDeduction::class);
});

// test an income can have many taxes
test('an income can have many taxes', function () {
    $model = Income::factory()->create();

    $tax = $model->taxes()->create([
        'name' => 'Test Tax',
        'amount' => 100,
        'active' => true,
    ]);

    expect($model->taxes->count())->toBe(1);
    expect($model->taxes->first())->toBeInstanceOf(IncomeTax::class);
});

// test the income frequency is an enum
test('the income frequency is an enum', function () {
    $model = Income::factory()->create();

    expect($model->frequency)->toBeInstanceOf(Frequency::class);
    expect($model->frequency->value)->toBeString();
});

// test if the income is assigned to a user who is removed from the budget, the user_id is set to null
test('if the income is assigned to a user who is removed from the budget, the user_id is set to null', function () {
    $budget = Budget::factory()->create();

    $user = User::factory()->create();

    $budget->addMember($user);

    $income = Income::factory()->create([
        'budget_id' => $budget->id,
        'user_id' => $user->id,
    ]);

    expect($income->user_id)->toBe($user->id);

    $budget->removeMember($user);

    $income->refresh();

    expect($income->user_id)->toBeNull();
});

// test soft deletes
test('soft deletes', function () {
    $model = Income::factory()->create();

    $model->delete();

    expect($model->deleted_at)->not()->toBeNull();
});

// test soft deleted models are pruned after 30 days
test('soft deleted models are pruned after 30 days', function () {
    $model = Income::factory()->create();

    $model->delete();

    expect($model->deleted_at)->not()->toBeNull();

    $model->deleted_at = now()->subDays(31);

    $model->save();

    // run the prune command
    $this->artisan('model:prune', [
        '--model' => Income::class,
    ]);

    expect(Income::count())->toBe(0);
});
