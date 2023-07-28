<?php

use App\Domains\Budgets\Models\Budget;
use App\Domains\Users\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

function carbon(): Carbon
{
    return new Carbon();
}

/**
 * Get the authenticated user's current budget.
 */
function currentBudget(): ?Budget
{
    if (! auth()->check()) {
        return null;
    }

    $budget = user()?->currentBudget;

    if (! $budget) {
        $budget = user()?->ownedBudgets()->first();
    }

    return $budget;
}

/**
 * Get the current authenticated user.
 */
function user(): ?User
{
    /** @var User $user */
    $user = auth()->user();

    $user?->loadMissing('currentBudget');

    return $user;
}