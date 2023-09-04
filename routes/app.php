<?php

use App\Controllers\App\Budgets\BudgetInvitationsController;
use App\Controllers\App\Budgets\BudgetMembersController;
use App\Controllers\App\Budgets\BudgetsController;
use App\Controllers\App\Budgets\CurrentBudgetController;
use App\Controllers\App\CookiesController;
use App\Controllers\App\Incomes\IncomesController;
use App\Livewire\Pages\Budgets\CreateBudgetPage;
use App\Models\AssetAccount;
use App\Models\Expense;
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
| Accounts
|--------------------------------------------------------------------------
*/
Route::get('/accounts', function () {

    $accounts = currentBudget()->assetAccounts;

    return view('app.accounts.index', [
        'accounts' => $accounts,
    ]);

})->middleware(['auth', 'verified'])
    ->name('app.accounts.index');

Route::view('/accounts/create', 'app.accounts.create')
    ->middleware(['auth', 'verified'])
    ->name('app.accounts.create');

Route::get('/accounts/{account}', function (AssetAccount $account) {

    $account = currentBudget()->assetAccounts()->findOrFail($account->id);

    return view('app.accounts.show', [
        'account' => $account,
    ]);

})->middleware(['auth', 'verified'])
    ->name('app.accounts.show');

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
| Expenses
|--------------------------------------------------------------------------
*/
Route::get('/expenses', function () {

    return view('app.expenses.index', [
        'expenses' => currentBudget()->expenses,
    ]);
})
    ->middleware(['auth', 'verified'])
    ->name('app.expenses.index');

Route::view('/expenses/create', 'app.expenses.create')
    ->middleware(['auth', 'verified'])
    ->name('app.expenses.create');

Route::get('/expenses/{expense}', function (Expense $expense) {

    $expense = currentBudget()->expenses()->findOrFail($expense->id);

    return view('app.expenses.show', [
        'expense' => $expense,
    ]);

})->middleware(['auth', 'verified'])
    ->name('app.expenses.show');

/*
|--------------------------------------------------------------------------
| Transactions
|--------------------------------------------------------------------------
*/
Route::get('/transactions', function () {

    $transactions = currentBudget()->transactions;

    return view('app.transactions.index', [
        'transactions' => $transactions,
    ]);

})->middleware(['auth', 'verified'])
    ->name('app.transactions.index');

Route::get('/transactions/create', function () {

    $accounts = currentBudget()->accounts;

    return view('app.transactions.create', [
        'accounts' => $accounts,
    ]);

})->middleware(['auth', 'verified'])
    ->name('app.transactions.create');

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

/*
|--------------------------------------------------------------------------
| Error Pages
|--------------------------------------------------------------------------
*/
Route::view('/errors/404', 'app.errors.404')
    ->name('app.errors.404');
