<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
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
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (NotFoundHttpException $e, Request $request) {

            $requestDomain = $request->server('HTTP_HOST');
            $appDomain = (string) str(config('app.app_url'))->replace('http://', '')->replace('https://', '');

            // if the request is on the 'app' subdomain, redirect to the app index
            if ($requestDomain === $appDomain) {
                return redirect()->route('app.errors.404');
            }
        });
    }
}
