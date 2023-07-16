<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use WireElements\Pro\Components\Spotlight\Spotlight;
use WireElements\Pro\Components\Spotlight\SpotlightQuery;
use WireElements\Pro\Components\Spotlight\SpotlightResult;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Spotlight::registerGroup('pages', 'Pages');

        Spotlight::setup(function () {

            // Here you can access the user, request, etc.
            // auth()->user() // Returns current user

            Spotlight::registerQueries(
                SpotlightQuery::asDefault(function ($query) {
                    $collection = collect();

                    $collection->push(
                        SpotlightResult::make()
                            ->setTitle('Dashboard')
                            ->setTypeahead('Dashboard')
                            ->setGroup('pages')
                            ->setAction('jump_to', ['path' => route('app.index')]),
                        SpotlightResult::make()
                            ->setTitle('Calendar')
                            ->setTypeahead('Calendar')
                            ->setGroup('pages')
                            ->setAction('jump_to', ['path' => route('app.calendar.index')]),
                        SpotlightResult::make()
                            ->setTitle('Incomes')
                            ->setTypeahead('Incomes')
                            ->setGroup('pages')
                            ->setAction('jump_to', ['path' => route('app.incomes.index')]),
                        SpotlightResult::make()
                            ->setTitle('Budgets')
                            ->setTypeahead('Budgets')
                            ->setGroup('pages')
                            ->setAction('jump_to', ['path' => route('app.budgets.index')]),
                    );

                    $collection = $collection->when(! blank($query), function ($collection) use ($query) {
                        return $collection->where(fn (SpotlightResult $result) => str($result->title())->lower()->contains(str($query)->lower()));
                    });

                    return $collection;
                })
            );
        });
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
