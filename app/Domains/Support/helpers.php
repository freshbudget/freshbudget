<?php

use App\Domains\Budgets\Models\Budget;
use App\Domains\Users\Models\User;
use Illuminate\Support\Carbon;

function carbon(): Carbon
{
    return new Carbon();
}

function currentBudget(): ?Budget
{
    if (! auth()->check()) {
        return null;
    }

    $budget = user()?->currentBudget;

    if (! $budget) {
        // get the first budget
        $budget = user()?->ownedBudgets()->first();
    }

    return $budget;
}

function user(): ?User
{
    $user = auth()->user();

    $user->loadMissing('currentBudget');

    return $user;
}
