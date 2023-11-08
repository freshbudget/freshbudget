<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Budget;
use App\Models\Income;
use Livewire\Livewire;
use App\Models\Account;
use App\Models\AssetAccount;
use Illuminate\Foundation\Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
use App\Livewire\Wizards\Incomes\AddEntitlementsStep;
use App\Livewire\Wizards\Incomes\ConfigureIncomeWizard;

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
        $this->registerLiveWireComponents();
    }

    protected function registerLiveWireComponents(): void
    {
        Livewire::component('wizards.incomes.configure-income-wizard', ConfigureIncomeWizard::class);
        Livewire::component('wizards.incomes.add-entitlements-step', AddEntitlementsStep::class);
    }
}
