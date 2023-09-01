<?php

namespace App\Providers;

use App\Domains\Budgets\Models\Budget;
use App\Domains\Incomes\Models\Income;
use App\Domains\Incomes\Models\IncomeEntitlement;
use App\Domains\Users\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Relation::enforceMorphMap([
            'budget' => Budget::class,
            'income' => Income::class,
            'income.entitlement' => IncomeEntitlement::class,
            'user' => User::class,
        ]);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Debugbar::disable();
        Model::preventLazyLoading(! $this->app->isLocal());
        Model::preventSilentlyDiscardingAttributes(! $this->app->isProduction());
    }
}
