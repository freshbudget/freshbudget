<?php

namespace App\Domains\Incomes\Policies;

use App\Domains\Budgets\Models\Budget;
use App\Domains\Incomes\Models\Income;
use App\Domains\Users\Models\User;

class IncomePolicy
{
    public function create(User $user, Budget $budget): bool
    {
        return $budget->users->contains($user);
    }
    
    public function show(User $user, Income $income, Budget $budget): bool
    {
        // check that the income belongs to the budget
        if ($income->budget_id !== $budget->id) {
            return false;
        }

        // check that the user is a member of the budget
        if (! $budget->users->contains($user)) {
            return false;
        }

        return true;
    }

    public function viewAny(User $user, Budget $budget): bool
    {
        return $budget->users->contains($user);
    }
}