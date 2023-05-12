<?php

use App\Http\Controllers\Invitations\BudgetInvitationsController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'app.index')
    ->middleware(['auth'])
    ->name('app.index');

// Budget Invitations
Route::get('/invitations/{invitation}', [BudgetInvitationsController::class, 'show'])
    ->middleware(['throttle:5,1'])
    ->name('invitations.accept');
