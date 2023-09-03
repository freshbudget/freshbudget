<?php

namespace App\Policies;

use App\Models\Account;
use App\Models\Budget;
use App\Models\User;

class AccountPolicy
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

    public function view(User $user, Account $account, Budget $budget)
    {
        // check that the account belongs to the budget
        if ($account->budget_id !== $budget->id) {
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

    public function update(User $user, Account $account, Budget $budget)
    {
        if ($account->budget_id !== $budget->id) {
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

    public function delete(User $user, Account $account, Budget $budget)
    {
        if ($account->budget_id !== $budget->id) {
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

    public function forceDelete(User $user, Account $account, Budget $budget)
    {
        if ($account->budget_id !== $budget->id) {
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

    public function restore(User $user, Account $account, Budget $budget)
    {
        if ($account->budget_id !== $budget->id) {
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
}
