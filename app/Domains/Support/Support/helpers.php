<?php

use App\Domains\Budgets\Models\Budget;
use App\Domains\Users\Models\User;

function user(): User|null
{
    return auth()->user();
}

function currentBudget(): Budget|null
{
    return user()?->currentBudget;
}
