<?php

use App\Controllers\App\Budgets\BudgetInvitationsController;
use App\Controllers\App\Budgets\BudgetMembersController;
use App\Controllers\App\Budgets\BudgetsController;
use App\Controllers\App\Budgets\CurrentBudgetController;
use App\Controllers\App\CookiesController;
use App\Controllers\App\Incomes\IncomeDeductionsController;
use App\Controllers\App\Incomes\IncomeEntitlementsController;
use App\Controllers\App\Incomes\IncomeEntriesController;
use App\Controllers\App\Incomes\IncomesController;
use App\Controllers\App\Incomes\IncomeTaxesController;
use App\Livewire\Pages\Budgets\CreateBudgetPage;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Application Dashboard
|--------------------------------------------------------------------------
*/
Route::view('/', 'app.index')
    ->middleware(['auth', 'verified'])
    ->name('app.index');

/*
|--------------------------------------------------------------------------
| Calendar
|--------------------------------------------------------------------------
*/
Route::view('/calendar', 'app.calendar.index')
    ->middleware(['auth', 'verified'])
    ->name('app.calendar.index');

/*
|--------------------------------------------------------------------------
| Incomes
|--------------------------------------------------------------------------
*/
Route::get('/incomes', [IncomesController::class, 'overview'])
    ->middleware(['auth', 'verified'])
    ->name('app.incomes.index');

Route::get('/incomes/list', [IncomesController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('app.incomes.list');

Route::view('/incomes/create', 'app.incomes.create')
    ->middleware(['auth', 'verified'])
    ->name('app.incomes.create');

Route::get('/incomes/{income}', [IncomesController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('app.incomes.show');

Route::delete('/incomes/{income}', [IncomesController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('app.incomes.destroy');

Route::get('/incomes/{income}/settings', [IncomesController::class, 'edit'])
    ->middleware(['auth', 'verified'])
    ->name('app.incomes.edit');

Route::put('/incomes/{income}', [IncomesController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('app.incomes.update');

/*
|--------------------------------------------------------------------------
| Incomes Entries
|--------------------------------------------------------------------------
*/
// Route::get('/incomes/{account}/entries/create', [IncomeEntriesController::class, 'create'])
//     ->middleware(['auth', 'verified'])
//     ->name('app.incomes.entries.create');

/*
|--------------------------------------------------------------------------
| Income Entitlements
|--------------------------------------------------------------------------
*/
// Route::get('/incomes/{income}/entitlements', [IncomeEntitlementsController::class, 'show'])
//     ->middleware(['auth', 'verified'])
//     ->name('app.incomes.entitlements.show');

// Route::get('/incomes/{income}/entitlements/create', [IncomeEntitlementsController::class, 'create'])
//     ->middleware(['auth', 'verified'])
//     ->name('app.incomes.entitlements.create');

// Route::post('/incomes/{income}/entitlements', [IncomeEntitlementsController::class, 'store'])
//     ->middleware(['auth', 'verified'])
//     ->name('app.incomes.entitlements.store');

// Route::get('/incomes/{income}/entitlements/{entitlement}/edit', [IncomeEntitlementsController::class, 'edit'])
//     ->middleware(['auth', 'verified'])
//     ->name('app.incomes.entitlements.edit')
//     ->scopeBindings();

// Route::put('/incomes/{income}/entitlements/{entitlement}', [IncomeEntitlementsController::class, 'update'])
//     ->middleware(['auth', 'verified'])
//     ->name('app.incomes.entitlements.update')
//     ->scopeBindings();

/*
|--------------------------------------------------------------------------
| Income Taxes
|--------------------------------------------------------------------------
*/
// Route::get('/incomes/{account}/taxes', [IncomeTaxesController::class, 'show'])
//     ->middleware(['auth', 'verified'])
//     ->name('app.incomes.taxes.show');

// Route::get('/incomes/{account}/taxes/create', [IncomeTaxesController::class, 'create'])
//     ->middleware(['auth', 'verified'])
//     ->name('app.incomes.taxes.create');

// Route::post('/incomes/{account}/taxes', [IncomeTaxesController::class, 'store'])
//     ->middleware(['auth', 'verified'])
//     ->name('app.incomes.taxes.store');

/*
|--------------------------------------------------------------------------
| Income Deductions
|--------------------------------------------------------------------------
*/
// Route::get('/incomes/{account}/deductions/create', [IncomeDeductionsController::class, 'create'])
//     ->middleware(['auth', 'verified'])
//     ->name('app.incomes.deductions.create');

// Route::post('/incomes/{account}/deductions', [IncomeDeductionsController::class, 'store'])
//     ->middleware(['auth', 'verified'])
//     ->name('app.incomes.deductions.store');

// Route::get('/incomes/{account}/deductions', [IncomeDeductionsController::class, 'show'])
//     ->middleware(['auth', 'verified'])
//     ->name('app.incomes.deductions.show');

/*
|--------------------------------------------------------------------------
| Account Settings
|--------------------------------------------------------------------------
*/
Route::view('/settings', 'app.settings.personal')
    ->middleware(['auth', 'verified'])
    ->name('app.settings.personal');

Route::view('/settings/security', 'app.settings.security')
    ->middleware(['auth', 'verified'])
    ->name('app.settings.security');

/*
|--------------------------------------------------------------------------
| Budgets
|--------------------------------------------------------------------------
*/
Route::get('/budgets', [BudgetsController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('app.budgets.index');

Route::post('/budgets', [BudgetsController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('app.budgets.store');

Route::get('/budgets/create', CreateBudgetPage::class)
    ->middleware(['auth', 'verified'])
    ->name('app.budgets.create');

Route::post('/budgets/{budget}/current', CurrentBudgetController::class)
    ->middleware(['auth', 'verified'])
    ->name('app.budgets.current');

Route::get('/budgets/{budget}', [BudgetsController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('app.budgets.show');

Route::put('/budgets/{budget}', [BudgetsController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('app.budgets.update');

Route::get('/budgets/{budget}/members', [BudgetMembersController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('app.budgets.members.index');

Route::delete('/budgets/{budget}/invitations/{invitation}', [BudgetInvitationsController::class, 'destroy'])
    ->scopeBindings()
    ->middleware(['auth', 'verified'])
    ->name('app.budgets.invitations.destroy');

Route::get('/budgets/{budget}/settings', [BudgetsController::class, 'edit'])
    ->middleware(['auth', 'verified'])
    ->name('app.budgets.edit');

Route::delete('/budgets/{budget}', [BudgetsController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('app.budgets.destroy');

/*
|--------------------------------------------------------------------------
| Budget Files Explorer
|--------------------------------------------------------------------------
*/
Route::view('/files', 'app.files.index')
    ->middleware(['auth', 'verified'])
    ->name('app.files.index');

/*
|--------------------------------------------------------------------------
| UI State Management
|--------------------------------------------------------------------------
*/
Route::post('/cookies/{cookie}', CookiesController::class)
    ->middleware(['auth', 'verified'])
    ->name('app.cookies.update');
