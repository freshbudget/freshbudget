<?php

use App\Models\AssetAccount;
use App\Models\Budget;
use App\Models\Income;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('app.index'));
});

/*
|--------------------------------------------------------------------------
| Budgets
|--------------------------------------------------------------------------
*/
Breadcrumbs::for('app.budgets.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Budgets', route('app.budgets.index'));
});

Breadcrumbs::for('app.budgets.show', function (BreadcrumbTrail $trail, Budget $budget) {
    $trail->parent('app.budgets.index');
    $trail->push($budget->name, route('app.budgets.show', $budget));
});

/*
|--------------------------------------------------------------------------
| Incomes
|--------------------------------------------------------------------------
*/
Breadcrumbs::for('app.incomes.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Incomes', route('app.incomes.index'));
});

Breadcrumbs::for('app.incomes.show', function (BreadcrumbTrail $trail, Income $income) {
    $trail->parent('app.incomes.index');
    $trail->push($income->name, route('app.incomes.show', $income));
});

/*
|--------------------------------------------------------------------------
| Accounts
|--------------------------------------------------------------------------
*/
Breadcrumbs::for('app.accounts.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Accounts', route('app.accounts.index'));
});

Breadcrumbs::for('app.accounts.show', function (BreadcrumbTrail $trail, AssetAccount $account) {
    $trail->parent('app.accounts.index');
    $trail->push($account->name, route('app.accounts.show', $account));
});
