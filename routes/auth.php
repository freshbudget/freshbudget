<?php

use Illuminate\Http\Request;
use App\Controllers\Auth\EmailVerificationRequestController;
use App\Livewire\Auth\EmailVerificationRequestForm;
use App\Livewire\Auth\PasswordResetForm;
use App\Livewire\Auth\PasswordResetRequestForm;
use App\Livewire\Pages\Auth\Login;
use App\Livewire\Pages\Auth\Register;
use Illuminate\Support\Facades\Route;

Route::get('/register', Register::class)
    ->middleware(['guest', 'throttle:50,1'])
    ->name('register');

Route::get('/login', Login::class)
    ->middleware(['guest', 'throttle:50,1'])
    ->name('login');

Route::get('/email/verification', EmailVerificationRequestForm::class)
    ->middleware(['auth'])
    ->name('verification.notice');

Route::get('/email/verification/{id}/{hash}', [EmailVerificationRequestController::class, 'attempt'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::get('/password/forgot', PasswordResetRequestForm::class)
    ->middleware(['guest'])
    ->name('password.request');

Route::get('/password/reset', PasswordResetForm::class)
    ->middleware(['guest'])
    ->name('password.reset');

Route::post('/logout', function(Request $request) {
    auth()->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect()->route('welcome');
})->middleware(['auth'])->name('logout');

// Route::get('/password/confirm', PasswordConfirmForm::class)
//     ->middleware(['auth'])
//     ->name('password.confirm');
