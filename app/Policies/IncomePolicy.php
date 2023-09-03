<?php

namespace App\Policies;

use App\Models\Budget;
use App\Models\Income;
use App\Models\User;

class IncomePolicy
{
    public function create(User $user, Budget $budget)
    {
        if (! $budget->hasMember($user)) {
            return false;
        }

        // if (! $user->can('create account', $budget)) {
        //     return false;
        // }

        return true;
    }

    public function viewAny(User $user, Budget $budget)
    {
        if (! $budget->hasMember($user)) {
            return false;
        }

        // if (! $user->can('view accounts', $budget)) {
        //     return false;
        // }

        return true;
    }

    public function view(User $user, Income $income, Budget $budget)
    {
        // check that the account belongs to the budget
        if ($income->budget_id !== $budget->id) {
            return false;
        }

        if (! $budget->hasMember($user)) {
            return false;
        }

        // if (! $user->can('view accounts', $budget)) {
        //     return false;
        // }

        return true;
    }

    public function update(User $user, Income $income, Budget $budget)
    {
        if ($income->budget_id !== $budget->id) {
            return false;
        }

        if (! $budget->hasMember($user)) {
            return false;
        }

        // if (! $user->can('edit accounts', $budget)) {
        //     return false;
        // }

        return true;
    }

    public function delete(User $user, Income $income, Budget $budget)
    {
        if ($income->budget_id !== $budget->id) {
            return false;
        }

        if (! $budget->hasMember($user)) {
            return false;
        }

        // if (! $user->can('delete accounts', $budget)) {
        //     return false;
        // }

        return true;
    }

    public function forceDelete(User $user, Income $income, Budget $budget)
    {
        if ($income->budget_id !== $budget->id) {
            return false;
        }

        if (! $budget->hasMember($user)) {
            return false;
        }

        // if (! $user->can('force delete accounts', $budget)) {
        //     return false;
        // }

        return true;
    }

    public function restore(User $user, Income $income, Budget $budget)
    {
        if ($income->budget_id !== $budget->id) {
            return false;
        }

        if (! $budget->hasMember($user)) {
            return false;
        }

        // if (! $user->can('restore accounts', $budget)) {
        //     return false;
        // }

        return true;
    }

    public function addDeductions(User $user, Income $income, Budget $budget): bool
    {
        // check that the income belongs to the budget
        if ($income->budget_id !== $budget->id) {
            return false;
        }

        // check that the user is a member of the budget
        if (! $budget->hasMember($user)) {
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
        if (! $budget->hasMember($user)) {
            return false;
        }

        return true;
    }

    public function addEntry(User $user, Income $income, Budget $budget)
    {
        // check that the income belongs to the budget
        if ($income->budget_id !== $budget->id) {
            return false;
        }

        // check that the user is a member of the budget
        if (! $budget->hasMember($user)) {
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
        if (! $budget->hasMember($user)) {
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
        if (! $budget->hasMember($user)) {
            return false;
        }

        return true;
    }
}
