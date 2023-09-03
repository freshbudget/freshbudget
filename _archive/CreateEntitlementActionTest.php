<?php

use App\Domains\Incomes\Actions\CreateIncomeEntitlementAction;
use App\Domains\Incomes\Actions\UpdateIncomeEntitlementEstimate;
use App\Domains\Incomes\Models\Income;
use App\Domains\Shared\Enums\AccountType;
use App\Models\Account;

// // test that the action creates an entitlement
// test('the action creates an entitlement', function () {
//     $income = Account::factory()->create([
//         'type' => AccountType::REVENUE,
//     ]);

//     $data = [
//         'name' => 'Test Entitlement',
//         'amount' => '100.00',
//     ];

//     $entitlement = (new CreateIncomeEntitlementAction($income, $data))->execute();
//     (new UpdateIncomeEntitlementEstimate($income))->execute();

//     expect($entitlement->name)->toBe('Test Entitlement');
//     expect($entitlement->amount)->toBe(10000);
// });

// // test the amount is stripped of commas and dollar signs and converted to cents
// test('the amount is stripped of commas and dollar signs and converted to cents', function () {
//     $income = Income::factory()->create();

//     $data = [
//         'name' => 'Test Entitlement',
//         'amount' => '$1,000.00',
//     ];

//     $entitlement = (new CreateIncomeEntitlementAction($income, $data))->execute();
//     (new UpdateIncomeEntitlementEstimate($income))->execute();

//     expect($entitlement->name)->toBe('Test Entitlement');
//     expect($entitlement->amount)->toBe(100000);
// });

// // test the action when given data with a name that already exists, it creates a new entitlement and deactivates the existing one
// test('the action when given data with a name that already exists, it updates the existing entitlement', function () {
//     $income = Income::factory()->create();

//     $data = [
//         'name' => 'Test Entitlement',
//         'amount' => '100.00',
//     ];

//     $original = (new CreateIncomeEntitlementAction($income, $data))->execute();
//     (new UpdateIncomeEntitlementEstimate($income))->execute();

//     expect($original->name)->toBe('Test Entitlement');
//     expect($original->amount)->toBe(10000);

//     $data = [
//         'name' => 'Test Entitlement',
//         'amount' => '200.00',
//     ];

//     $new = (new CreateIncomeEntitlementAction($income, $data))->execute();
//     (new UpdateIncomeEntitlementEstimate($income))->execute();

//     expect($new->name)->toBe('Test Entitlement');
//     expect($new->amount)->toBe(20000);
// });

// // test that when the active flag is set to false, the entitlement is not active
// test('when the active flag is set to false, the entitlement is not active', function () {
//     $income = Income::factory()->create();

//     $data = [
//         'name' => 'Test Entitlement',
//         'amount' => '100.00',
//     ];

//     $entitlement = (new CreateIncomeEntitlementAction($income, $data))->execute();
//     (new UpdateIncomeEntitlementEstimate($income))->execute();

//     expect($entitlement->name)->toBe('Test Entitlement');
//     expect($entitlement->amount)->toBe(10000);
// });

// // test that when the active flag is not set, the entitlement is active
// test('when the active flag is not set, the entitlement is active', function () {
//     $income = Income::factory()->create();

//     $data = [
//         'name' => 'Test Entitlement',
//         'amount' => '100.00',
//     ];

//     $entitlement = (new CreateIncomeEntitlementAction($income, $data))->execute();
//     (new UpdateIncomeEntitlementEstimate($income))->execute();

//     expect($entitlement->name)->toBe('Test Entitlement');
//     expect($entitlement->amount)->toBe(10000);
// });

// test('when the action is executed, it updates the income\'s estimated_entitlements_per_period', function () {
//     $income = Income::factory()->create();

//     expect($income->estimated_entitlements_per_period)->toBe(0);

//     $data = [
//         'name' => 'Test Entitlement',
//         'amount' => '100.00',
//     ];

//     (new CreateIncomeEntitlementAction($income, $data))->execute();
//     (new UpdateIncomeEntitlementEstimate($income))->execute();

//     expect($income->estimated_entitlements_per_period)->toBe(10000);

//     $data = [
//         'name' => 'Test Entitlement 2',
//         'amount' => '200.00',
//     ];

//     (new CreateIncomeEntitlementAction($income, $data))->execute();
//     (new UpdateIncomeEntitlementEstimate($income))->execute();

//     expect($income->estimated_entitlements_per_period)->toBe(30000);
// });

// test('when an entitlement with the same name already exists, the existing entitlement is deactivated and the income\'s estimated_entitlements_per_period is correct', function () {
//     $income = Income::factory()->create();

//     expect($income->estimated_entitlements_per_period)->toBe(0);

//     $data = [
//         'name' => 'Test Entitlement',
//         'amount' => '100.00',
//     ];

//     (new CreateIncomeEntitlementAction($income, $data))->execute();
//     (new UpdateIncomeEntitlementEstimate($income))->execute();

//     expect($income->estimated_entitlements_per_period)->toBe(10000);

//     $data = [
//         'name' => 'Test Entitlement',
//         'amount' => '200.00',
//     ];

//     (new CreateIncomeEntitlementAction($income, $data))->execute();
//     (new UpdateIncomeEntitlementEstimate($income))->execute();

//     expect($income->estimated_entitlements_per_period)->toBe(30000);

//     expect($income->entitlements()->count())->toBe(2);
// });
