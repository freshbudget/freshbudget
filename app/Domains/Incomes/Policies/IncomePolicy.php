<?php

namespace App\Domains\Incomes\Policies;

use App\Domains\Budgets\Models\Budget;
use App\Domains\Incomes\Models\Income;
use App\Domains\Users\Models\User;

class IncomePolicy
{
    public function addDeductions(User $user, Income $income, Budget $budget): bool
    {
        // check that the income belongs to the budget
        if ($income->budget_id !== $budget->id) {
            return false;
        }

        // check that the user is a member of the budget
        if (! $budget->hasUser($user)) {
            return false;
        }

        return true;
    }

    public function addEntitlements(User $user, Income $income, Budget $budget): bool
    {
        // check that the income belongs to the budget
        if ($income->budget_id !== $budget->id) {
            return false;
        }

        // check that the user is a member of the budget
        if (! $budget->hasUser($user)) {
            return false;
        }

        return true;
    }

    public function editEntitlements(User $user, Income $income, Budget $budget): bool
    {
        // check that the income belongs to the budget
        if ($income->budget_id !== $budget->id) {
            return false;
        }

        // check that the user is a member of the budget
        if (! $budget->hasUser($user)) {
            return false;
        }

        return true;
    }

    public function addTaxes(User $user, Income $income, Budget $budget): bool
    {
        // check that the income belongs to the budget
        if ($income->budget_id !== $budget->id) {
            return false;
        }

        // check that the user is a member of the budget
        if (! $budget->hasUser($user)) {
            return false;
        }

        return true;
    }

    public function create(User $user, Budget $budget): bool
    {
        return $budget->members->contains($user);
    }

    public function delete(User $user, Income $income, Budget $budget): bool
    {
        // check that the income belongs to the budget
        if ($income->budget_id !== $budget->id) {
            return false;
        }

        // check that the user is a member of the budget
        if (! $budget->hasUser($user)) {
            return false;
        }

        return true;
    }

    public function view(User $user, Income $income, Budget $budget): bool
    {
        // check that the income belongs to the budget
        if ($income->budget_id !== $budget->id) {
            return false;
        }

        // check that the user is a member of the budget
        if (! $budget->members->contains($user)) {
            return false;
        }

        return true;
    }

    public function update(User $user, Income $income, Budget $budget): bool
    {
        // check that the income belongs to the budget
        if ($income->budget_id !== $budget->id) {
            return false;
        }

        // check that the user is a member of the budget
        if (! $budget->hasUser($user)) {
            return false;
        }

        return true;
    }

    public function viewAny(User $user, Budget $budget): bool
    {
        return $budget->members->contains($user);
    }
}
