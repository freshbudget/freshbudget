<?php

use App\Http\Controllers\Invitations\BudgetInvitationsController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'app.index')
    ->middleware(['auth'])
    ->name('app.index');

Route::post('/invitations/{invitation}/accept', [BudgetInvitationsController::class, 'accept'])
    ->middleware(['auth'])
    ->name('invitations.accept');
