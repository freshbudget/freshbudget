<?php

use App\Incomes\IncomesController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'app.index')
    ->middleware(['auth'])
    ->name('app.index');

Route::get('/incomes', [IncomesController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('app.incomes.index');

Route::get('/incomes/create', [IncomesController::class, 'create'])
    ->middleware(['auth'])
    ->name('app.incomes.create');

Route::get('/incomes/{income}', [IncomesController::class, 'show'])
    ->middleware(['auth'])
    ->name('app.incomes.show');
