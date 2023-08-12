<?php

namespace App\Domains\Accounts\Policies;

use App\Domains\Budgets\Models\Budget;
use App\Domains\Users\Models\User;

class AccountPolicy
{
    public function create(User $user, Budget $budget)
    {
        if (! $budget->hasMember($user)) {
            return false;
        }

        if (! $user->can('create account', $budget)) {
            return false;
        }

        return true;
    }

    public function viewAny(User $user, Budget $budget)
    {
        if (! $budget->hasMember($user)) {
            return false;
        }

        if (! $user->can('view accounts', $budget)) {
            return false;
        }

        return true;
    }

    public function view(User $user, Budget $budget)
    {
        if (! $budget->hasMember($user)) {
            return false;
        }

        if (! $user->can('view accounts', $budget)) {
            return false;
        }

        return true;
    }

    public function update(User $user, Budget $budget)
    {
        if (! $budget->hasMember($user)) {
            return false;
        }

        if (! $user->can('edit accounts', $budget)) {
            return false;
        }

        return true;
    }

    public function delete(User $user, Budget $budget)
    {
        if (! $budget->hasMember($user)) {
            return false;
        }

        if (! $user->can('delete accounts', $budget)) {
            return false;
        }

        return true;
    }

    public function forceDelete(User $user, Budget $budget)
    {
        if (! $budget->hasMember($user)) {
            return false;
        }

        if (! $user->can('force delete accounts', $budget)) {
            return false;
        }

        return true;
    }

    public function restore(User $user, Budget $budget)
    {
        if (! $budget->hasMember($user)) {
            return false;
        }

        if (! $user->can('restore accounts', $budget)) {
            return false;
        }

        return true;
    }
}
