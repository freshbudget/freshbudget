<?php

namespace App\Domains\Budgets\Policies;

use App\Domains\Budgets\Models\Budget;
use App\Domains\Users\Models\User;

class BudgetPolicy
{
    public function create(User $user): bool
    {
        return auth()->check();
    }

    public function viewAny(User $user): bool
    {
        return auth()->check();
    }
}
