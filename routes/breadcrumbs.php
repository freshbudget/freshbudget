<?php

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
