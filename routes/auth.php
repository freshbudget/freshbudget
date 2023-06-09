<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationRequestController;
use App\Http\Livewire\Auth\EmailVerificationRequestForm;
use App\Http\Livewire\Auth\LoginForm;
use App\Http\Livewire\Auth\PasswordResetForm;
use App\Http\Livewire\Auth\PasswordResetRequestForm;
use App\Http\Livewire\Auth\RegisterForm;
use Illuminate\Support\Facades\Route;

Route::get('/login', LoginForm::class)
    ->middleware(['guest', 'throttle:50,1'])
    ->name('login');

Route::get('/register', RegisterForm::class)
    ->middleware(['guest', 'throttle:50,1'])
    ->name('register');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware(['auth'])
    ->name('logout');

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

// Route::get('/password/confirm', PasswordConfirmForm::class)
//     ->middleware(['auth'])
//     ->name('password.confirm');
