<?php

namespace App\Providers;

use App\Domains\Budgets\Models\Budget;
use App\Domains\Incomes\Models\Income;
use App\Domains\Accounts\Models\Account;
use Illuminate\Validation\Rules\Password;
use App\Domains\Budgets\Policies\BudgetPolicy;
use App\Domains\Incomes\Policies\IncomePolicy;
use App\Domains\Accounts\Policies\AccountPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Income::class => IncomePolicy::class,
        Budget::class => BudgetPolicy::class,
        Account::class => AccountPolicy::class,
    ];

    public function boot(): void
    {
        Password::defaults(function () {
            return Password::min(8)
                ->letters()
                ->numbers();
        });
    }
}
