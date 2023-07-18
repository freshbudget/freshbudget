<?php

use App\Http\Controllers\Invitations\BudgetInvitationsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Basic Marketing Routes
|--------------------------------------------------------------------------
*/
Route::view('/', 'marketing.index')
    ->middleware(['cache.headers:public;max_age=86400;etag'])
    ->name('welcome');

Route::view('/terms', 'marketing.terms')
    ->middleware(['cache.headers:public;max_age=86400;etag'])
    ->name('terms');

Route::view('/privacy', 'marketing.privacy')
    ->middleware(['cache.headers:public;max_age=86400;etag'])
    ->name('privacy');

Route::view('/faq', 'marketing.faq')
    ->middleware(['cache.headers:public;max_age=86400;etag'])
    ->name('faq');

Route::view('/blog', 'blog.index')
    ->middleware(['cache.headers:public;max_age=86400;etag'])
    ->name('blog');

/*
|--------------------------------------------------------------------------
| Invitation Routes
|--------------------------------------------------------------------------
*/
Route::get('/invitations/{invitation}', [BudgetInvitationsController::class, 'show'])
    ->middleware(['throttle:50,1'])
    ->name('invitations.show');

Route::post('/invitations/{invitation}/accept', [BudgetInvitationsController::class, 'accept'])
    ->middleware(['auth'])
    ->name('invitations.accept');
