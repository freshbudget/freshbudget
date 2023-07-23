<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiters();

        $this->routes(function () {
            // domain.tld
            Route::middleware('web')
                ->domain(config('app.url'))
                ->group(base_path('routes/web.php'));

            // api.domain.tld
            // Route::middleware('api')
            //     ->domain(config('app.api_domain'))
            //     ->group(base_path('routes/api.php'));

            // app.domain.tld/{login|register|etc}
            Route::middleware('web')
                ->domain(config('app.app_url'))
                ->group(base_path('routes/auth.php'));

            // app.domain.tld
            Route::middleware(['web', 'verified'])
                ->domain(config('app.app_url'))
                ->group(base_path('routes/app.php'));
        });
    }

    protected function configureRateLimiters(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
