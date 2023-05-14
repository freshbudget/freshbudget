<?php

namespace App\Domains\Budgets\Policies;

use App\Domains\Users\Models\User;
use App\Domains\Budgets\Models\Budget;

class BudgetPolicy
{
    public function create(User $user): bool
    {
        return auth()->check();
    }

    public function view(User $user, Budget $budget): bool
    {
        return $budget->hasUser($user);
    }

    public function viewAny(User $user): bool
    {
        return auth()->check();
    }
}
