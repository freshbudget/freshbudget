<?php

use App\Livewire\Auth\EmailVerificationRequestForm;
use App\Livewire\Auth\PasswordResetForm;
use App\Livewire\Auth\PasswordResetRequestForm;
use App\Livewire\Pages\Auth\Login;
use App\Livewire\Pages\Auth\Register;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Registration
|--------------------------------------------------------------------------
*/
Route::get('/register', Register::class)
    ->middleware(['guest', 'throttle:50,1'])
    ->name('register');

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/
Route::get('/login', Login::class)
    ->middleware(['guest', 'throttle:50,1'])
    ->name('login');

/*
|--------------------------------------------------------------------------
| Password Resets & Confirmations
|--------------------------------------------------------------------------
*/
Route::get('/password/forgot', PasswordResetRequestForm::class)
    ->middleware(['guest'])
    ->name('password.request');

Route::get('/password/reset', PasswordResetForm::class)
    ->middleware(['guest'])
    ->name('password.reset');

// Route::get('/password/confirm', PasswordConfirmForm::class)
//     ->middleware(['auth'])
//     ->name('password.confirm');

/*
|--------------------------------------------------------------------------
| Email Verification
|--------------------------------------------------------------------------
*/
Route::get('/email/verification', EmailVerificationRequestForm::class)
    ->middleware(['auth'])
    ->name('verification.notice');

Route::get('/email/verification/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->intended(default: route('app.index'))
        ->with('status', 'Email verified!');
})->middleware(['auth', 'signed'])->name('verification.verify');

/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/
Route::post('/logout', function (Request $request) {
    auth()->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect()->route('welcome');
})->middleware(['auth'])->name('logout');
