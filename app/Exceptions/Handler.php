<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $requestDomain = request()->server('HTTP_HOST');
        $appDomain = (string) str(config('app.app_url'))
            ->replace('http://', '')
            ->replace('https://', '');

        $isLivewire = request()->is('livewire/*');

        if ($isLivewire) {
            return;
        }

        $this->renderable(function (NotFoundHttpException $e) use ($requestDomain, $appDomain) {
            if ($requestDomain === $appDomain) {
                return redirect()->route('app.errors.404');
            }
        });

        // render a custom 500 error page
        $this->renderable(function (Throwable $e) use ($requestDomain, $appDomain) {
            if ($requestDomain === $appDomain) {
                return redirect()->route('app.errors.500');
            }
        });
    }
}
