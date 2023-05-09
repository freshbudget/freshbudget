<?php

use App\Http\Livewire\Auth\LoginForm;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Auth\RegisterForm;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/login', LoginForm::class)
    ->middleware(['guest', 'throttle:50,1'])
    ->name('login');

Route::get('/register', RegisterForm::class)
    ->middleware(['guest', 'throttle:50,1'])
    ->name('register');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware(['auth'])
    ->name('logout');

// Route::get('/email/verification', [EmailVerificationRequestController::class, 'show'])
//     ->middleware(['auth'])
//     ->name('verification.notice');

// Route::post('/email/verification/send', [EmailVerificationRequestController::class, 'create'])
//     ->middleware(['auth', 'throttle:5,1'])
//     ->name('verification.send');

// Route::get('/email/verification/{id}/{hash}', [EmailVerificationRequestController::class, 'attempt'])
//     ->middleware(['auth', 'signed'])
//     ->name('verification.verify');

// Route::get('/password/confirm', PasswordConfirmationController::class)
//     ->middleware(['auth'])
//     ->name('password.confirm');
