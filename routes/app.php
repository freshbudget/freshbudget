<?php

use App\Http\Controllers\App\Budgets\BudgetsController;
use App\Http\Controllers\App\Budgets\CurrentBudgetController;
use App\Http\Controllers\App\Incomes\IncomesController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'app.index')
    ->middleware(['auth'])
    ->name('app.index');

Route::get('/budgets', [BudgetsController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('app.budgets.index');

Route::post('/budgets', [BudgetsController::class, 'store'])
    ->middleware(['auth'])
    ->name('app.budgets.store');

Route::get('/budgets/create', [BudgetsController::class, 'create'])
    ->middleware(['auth'])
    ->name('app.budgets.create');

Route::get('/budgets/{budget}', [BudgetsController::class, 'show'])
    ->middleware(['auth'])
    ->name('app.budgets.show');

Route::post('/budgets/{budget}/current', CurrentBudgetController::class)
    ->middleware(['auth'])
    ->name('app.budgets.current');

Route::get('/incomes', [IncomesController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('app.incomes.index');

Route::get('/incomes/create', [IncomesController::class, 'create'])
    ->middleware(['auth'])
    ->name('app.incomes.create');

Route::get('/incomes/{income}', [IncomesController::class, 'show'])
    ->middleware(['auth'])
    ->name('app.incomes.show');
