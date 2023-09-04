<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use WireElements\Pro\Components\Spotlight\Spotlight;
use WireElements\Pro\Components\Spotlight\SpotlightQuery;
use WireElements\Pro\Components\Spotlight\SpotlightResult;

class SpotlightServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        Spotlight::registerGroup('pages', 'Pages');
        Spotlight::registerGroup('incomes', 'Incomes');

        Spotlight::setup(function () {

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
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
