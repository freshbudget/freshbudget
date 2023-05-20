<?php

use App\Http\Controllers\Invitations\BudgetInvitationsController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'marketing.index')
    ->name('welcome');

Route::view('/terms', 'marketing.terms')
    ->name('terms');

Route::view('/privacy', 'marketing.privacy')
    ->name('privacy');

Route::view('/blog', 'blog.index')
    ->name('blog');

/*
|--------------------------------------------------------------------------
| Invitation Routes
|--------------------------------------------------------------------------|
*/
Route::get('/invitations/{invitation}', [BudgetInvitationsController::class, 'show'])
    ->middleware(['throttle:50,1'])
    ->name('invitations.show');

Route::post('/invitations/{invitation}/accept', [BudgetInvitationsController::class, 'accept'])
    ->middleware(['auth'])
    ->name('invitations.accept');
