<?php

namespace App\Providers;

use App\Domains\Incomes\Models\IncomeEntitlement;
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
            'income.entitlement' => IncomeEntitlement::class,
        ]);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Debugbar::disable();
        Model::preventLazyLoading(! $this->app->isLocal());
        Model::preventSilentlyDiscardingAttributes($this->app->isLocal());
    }
}
