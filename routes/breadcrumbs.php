<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('app.index'));
});

Breadcrumbs::for('app.budgets.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Budgets', route('app.budgets.index'));
});

Breadcrumbs::for('app.incomes.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Incomes', route('app.incomes.index'));
});
