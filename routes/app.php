<?php

use App\Http\Controllers\App\Budgets\BudgetInvitationsController;
use App\Http\Controllers\App\Budgets\BudgetMembersController;
use App\Http\Controllers\App\Budgets\BudgetsController;
use App\Http\Controllers\App\Budgets\CurrentBudgetController;
use App\Http\Controllers\App\CookiesController;
use App\Http\Controllers\App\Incomes\IncomeDeductionsController;
use App\Http\Controllers\App\Incomes\IncomeEntitlementsController;
use App\Http\Controllers\App\Incomes\IncomeEntriesController;
use App\Http\Controllers\App\Incomes\IncomesController;
use App\Http\Controllers\App\Incomes\IncomeTaxesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Application Dashboard
|--------------------------------------------------------------------------
*/
Route::view('/', 'app.index')
    ->middleware(['auth'])
    ->name('app.index');

/*
|--------------------------------------------------------------------------
| Account Settings
|--------------------------------------------------------------------------
*/
Route::view('/settings', 'app.settings.personal')
    ->middleware(['auth'])
    ->name('app.settings.personal');

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

Route::put('/budgets/{budget}', [BudgetsController::class, 'update'])
    ->middleware(['auth'])
    ->name('app.budgets.update');

Route::get('/budgets/{budget}/members', [BudgetMembersController::class, 'index'])
    ->middleware(['auth'])
    ->name('app.budgets.members.index');

Route::get('/budgets/{budget}/members/invite', [BudgetInvitationsController::class, 'create'])
    ->middleware(['auth'])
    ->name('app.budgets.members.invite');

Route::post('/budgets/{budget}/members', [BudgetInvitationsController::class, 'store'])
    ->middleware(['auth'])
    ->name('app.budgets.members.store');

Route::get('/budgets/{budget}/settings', [BudgetsController::class, 'edit'])
    ->middleware(['auth'])
    ->name('app.budgets.edit');

Route::delete('/budgets/{budget}', [BudgetsController::class, 'destroy'])
    ->middleware(['auth'])
    ->name('app.budgets.destroy');

Route::view('/calendar', 'app.calendar.index')
    ->middleware(['auth'])
    ->name('app.calendar.index');
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

Route::get('/incomes/{income}/edit', [IncomesController::class, 'edit'])
    ->middleware(['auth'])
    ->name('app.incomes.edit');

Route::put('/incomes/{income}', [IncomesController::class, 'update'])
    ->middleware(['auth'])
    ->name('app.incomes.update');

/*
|--------------------------------------------------------------------------
| Incomes Entries
|--------------------------------------------------------------------------
*/
Route::get('/incomes/{income}/entries/create', [IncomeEntriesController::class, 'create'])
    ->middleware(['auth'])
    ->name('app.incomes.entries.create');

/*
|--------------------------------------------------------------------------
| Income Entitlements
|--------------------------------------------------------------------------
*/
Route::get('/incomes/{income}/entitlements', [IncomeEntitlementsController::class, 'show'])
    ->middleware(['auth'])
    ->name('app.incomes.entitlements.show');

Route::get('/incomes/{income}/entitlements/create', [IncomeEntitlementsController::class, 'create'])
    ->middleware(['auth'])
    ->name('app.incomes.entitlements.create');

Route::post('/incomes/{income}/entitlements', [IncomeEntitlementsController::class, 'store'])
    ->middleware(['auth'])
    ->name('app.incomes.entitlements.store');

Route::get('/incomes/{income}/entitlements/{entitlement}/edit', [IncomeEntitlementsController::class, 'edit'])
    ->middleware(['auth'])
    ->name('app.incomes.entitlements.edit')
    ->scopeBindings();

Route::put('/incomes/{income}/entitlements/{entitlement}', [IncomeEntitlementsController::class, 'update'])
    ->middleware(['auth'])
    ->name('app.incomes.entitlements.update')
    ->scopeBindings();

/*
|--------------------------------------------------------------------------
| Income Taxes
|--------------------------------------------------------------------------
*/
Route::get('/incomes/{income}/taxes', [IncomeTaxesController::class, 'show'])
    ->middleware(['auth'])
    ->name('app.incomes.taxes.show');

Route::get('/incomes/{income}/taxes/create', [IncomeTaxesController::class, 'create'])
    ->middleware(['auth'])
    ->name('app.incomes.taxes.create');

Route::post('/incomes/{income}/taxes', [IncomeTaxesController::class, 'store'])
    ->middleware(['auth'])
    ->name('app.incomes.taxes.store');

/*
|--------------------------------------------------------------------------
| Income Deductions
|--------------------------------------------------------------------------
*/
Route::get('/incomes/{income}/deductions/create', [IncomeDeductionsController::class, 'create'])
    ->middleware(['auth'])
    ->name('app.incomes.deductions.create');

Route::post('/incomes/{income}/deductions', [IncomeDeductionsController::class, 'store'])
    ->middleware(['auth'])
    ->name('app.incomes.deductions.store');

Route::get('/incomes/{income}/deductions', [IncomeDeductionsController::class, 'show'])
    ->middleware(['auth'])
    ->name('app.incomes.deductions.show');

/*
|--------------------------------w----------------------------------------
| Budget Files Explorer
|--------------------------------------------------------------------------
*/
Route::view('/files', 'app.files.index')
    ->middleware(['auth'])
    ->name('app.files.index');

/*
|--------------------------------------------------------------------------
| UI State Management
|--------------------------------------------------------------------------
*/
Route::post('/cookies/{cookie}', CookiesController::class)
    ->middleware(['auth'])
    ->name('app.cookies.update');
