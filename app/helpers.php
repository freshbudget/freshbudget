<?php

use App\Models\Budget;
use App\Models\User;

/**
 * Get the authenticated user's current budget.
 */
if (! function_exists('currentBudget')) {

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

}
/**
 * Get the current authenticated user.
 */
if (! function_exists('user')) {

    function user(): ?User
    {
        /** @var User $user */
        $user = auth()->user();

        return $user;
    }

}
