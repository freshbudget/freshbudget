<?php

namespace App\Providers;

use App\Models\Account;
use App\Models\Budget;
use App\Models\Income;
use App\Policies\AccountPolicy;
use App\Policies\BudgetPolicy;
use App\Policies\IncomePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Validation\Rules\Password;

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
