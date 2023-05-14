<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Domains\Budgets\Models\Budget;
use App\Domains\Incomes\Models\Income;
use Illuminate\Validation\Rules\Password;
use App\Domains\Budgets\Policies\BudgetPolicy;
use App\Domains\Incomes\Policies\IncomePolicy;
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
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Password::defaults(function () {
            return Password::min(8)
                ->letters()
                ->numbers();
        });
    }
}
