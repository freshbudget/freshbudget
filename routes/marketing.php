<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'marketing.index')
    ->name('welcome');