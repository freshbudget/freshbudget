<?php

use App\Domains\Budgets\Models\Budget;
use App\Domains\Users\Models\User;
use Illuminate\Support\Carbon;

function carbon(): Carbon
{
    return new Carbon();
}

function currentBudget(): Budget|null
{
    return user()?->currentBudget;
}

function user(): User|null
{
    return auth()->user();
}
