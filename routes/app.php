<?php

use App\Http\Controllers\App\Budgets\BudgetsController;
use App\Http\Controllers\App\Budgets\CurrentBudgetController;
use App\Http\Controllers\App\Incomes\IncomeEntitlementsController;
use App\Http\Controllers\App\Incomes\IncomesController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'app.index')
    ->middleware(['auth'])
    ->name('app.index');

/*
|--------------------------------------------------------------------------
| Budgets
|--------------------------------------------------------------------------
*/
Route::get('/budgets', [BudgetsController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('app.budgets.index');

Route::post('/budgets', [BudgetsController::class, 'store'])
    ->middleware(['auth'])
    ->name('app.budgets.store');

Route::get('/budgets/create', [BudgetsController::class, 'create'])
    ->middleware(['auth'])
    ->name('app.budgets.create');

Route::post('/budgets/{budget}/current', CurrentBudgetController::class)
    ->middleware(['auth'])
    ->name('app.budgets.current');

Route::get('/budgets/{budget}', [BudgetsController::class, 'show'])
    ->middleware(['auth'])
    ->name('app.budgets.show');

Route::get('/budgets/{budget}/settings', [BudgetsController::class, 'edit'])
    ->middleware(['auth'])
    ->name('app.budgets.edit');

Route::delete('/budgets/{budget}', [BudgetsController::class, 'destroy'])
    ->middleware(['auth'])
    ->name('app.budgets.destroy');

/*
|--------------------------------------------------------------------------
| Incomes
|--------------------------------------------------------------------------
*/
Route::get('/incomes', [IncomesController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('app.incomes.index');

Route::get('/incomes/create', [IncomesController::class, 'create'])
    ->middleware(['auth'])
    ->name('app.incomes.create');

Route::get('/incomes/{income}', [IncomesController::class, 'show'])
    ->middleware(['auth'])
    ->name('app.incomes.show');

Route::delete('/incomes/{income}', [IncomesController::class, 'destroy'])
    ->middleware(['auth'])
    ->name('app.incomes.destroy');

Route::get('/incomes/{income}/entitlements/create', [IncomeEntitlementsController::class, 'create'])
    ->middleware(['auth'])
    ->name('app.incomes.entitlements.create');

Route::post('/incomes/{income}/entitlements', [IncomeEntitlementsController::class, 'store'])
    ->middleware(['auth'])
    ->name('app.incomes.entitlements.store');
