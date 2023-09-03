<?php

namespace App\Providers;

use App\Models\Account;
use App\Models\AssetAccount;
use App\Models\Budget;
use App\Models\Income;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Relation::enforceMorphMap([
            'account' => Account::class,
            'assetAccount' => AssetAccount::class,
            'budget' => Budget::class,
            'income' => Income::class,
            'user' => User::class,
        ]);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Debugbar::disable();
        /** @var Application $app */
        $app = $this->app;
        Model::preventLazyLoading(! $app->isLocal());
        Model::preventSilentlyDiscardingAttributes(! $app->isProduction());
    }
}
