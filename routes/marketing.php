<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'marketing.index')
    ->name('welcome');

Route::view('/terms', 'marketing.terms')
    ->name('terms');

Route::view('/privacy', 'marketing.privacy')
    ->name('privacy');