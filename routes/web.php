<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'marketing.index')
    ->name('welcome');

Route::view('/dashboard', 'app.index')
    ->middleware(['auth'])
    ->name('app.index');