<?php

use App\Domains\Incomes\Models\Income;
use App\Domains\Incomes\Models\IncomeEntitlement;
use App\Domains\Incomes\Models\IncomeFrequency;

// test an income can determine the total amount of entitlements
test('an income can determine the total amount of entitlements', function () {
    $model = Income::factory()->create();

    $model->entitlements()->create([
        'name' => 'Test Entitlement',
        'amount' => 1000,
        'start_date' => now(),
        'end_date' => null,
        'active' => true,
    ]);

    $model->entitlements()->create([
        'name' => 'Test Entitlement',
        'amount' => 250,
        'start_date' => now(),
        'end_date' => null,
        'active' => true,
    ]);

    expect($model->totalEntitlementPerPeriod())->toBeInt();
    expect($model->totalEntitlementPerPeriod())->toEqual(1250);
})->skip();

// test an inactive entitlement is not included in the total amount of entitlements
test('an inactive entitlement is not included in the total amount of entitlements', function () {
    $model = Income::factory()->create();

    $model->entitlements()->create([
        'name' => 'Test Entitlement',
        'amount' => 1000,
        'start_date' => now(),
        'end_date' => null,
        'active' => true,
    ]);

    $model->entitlements()->create([
        'name' => 'Test Entitlement',
        'amount' => 250,
        'start_date' => now(),
        'end_date' => null,
        'active' => false,
    ]);

    expect($model->totalEntitlementPerPeriod())->toBeInt();
    expect($model->totalEntitlementPerPeriod())->toEqual(1000);
})->skip();

// test an entitlement can have a parent or previous entitlement
test('an entitlement can have a parent or previous entitlement', function () {
    $model = Income::factory()->create();

    $parent = $model->entitlements()->create([
        'name' => 'Test Entitlement',
        'amount' => 1000,
        'start_date' => now(),
        'end_date' => null,
        'active' => false,
    ]);

    $child = $model->entitlements()->create([
        'name' => 'Test Entitlement',
        'amount' => 250,
        'start_date' => now(),
        'end_date' => null,
        'active' => true,
        'previous_id' => $parent->id,
    ]);

    expect($child->previous)->toBeInstanceOf(IncomeEntitlement::class);
    expect($child->previous->id)->toEqual($parent->id);
    expect($model->totalEntitlementPerPeriod())->toEqual(250);
})->skip();

// test an income can determine the total estimated amount of entitlements per month based on the frequency
test('an income can determine the total estimated amount of entitlements per month based on the frequency of monthly', function () {
    $model = Income::factory()->create([
        'frequency_id' => IncomeFrequency::where('name', 'Monthly')->first()->id,
    ]);

    $model->entitlements()->create([
        'name' => 'Test Entitlement',
        'amount' => 1000,
        'start_date' => now(),
        'end_date' => null,
        'active' => true,
    ]);

    expect($model->totalEntitlementPerPeriod())->toBeInt();
    expect($model->totalEntitlementPerPeriod())->toEqual(1000);

    expect($model->totalEstimatedEntitlementPerMonth())->toBeInt();
    expect($model->totalEstimatedEntitlementPerMonth())->toEqual(1000);
});

test('an income can determine the total estimated amount of entitlements per month based on the frequency of weekly', function () {
    $model = Income::factory()->create([
        'frequency_id' => IncomeFrequency::where('name', 'Weekly')->first()->id,
    ]);

    $model->entitlements()->create([
        'name' => 'Test Entitlement',
        'amount' => 1000,
        'start_date' => now(),
        'end_date' => null,
        'active' => true,
    ]);

    expect($model->totalEntitlementPerPeriod())->toBeInt();
    expect($model->totalEntitlementPerPeriod())->toEqual(1000);

    expect($model->totalEstimatedEntitlementPerMonth())->toBeInt();
    expect($model->totalEstimatedEntitlementPerMonth())->toEqual(4000);
})->skip();
