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

    public function delete(User $user, Budget $budget): bool
    {
        return $budget->isOwnedBy($user);
    }

    public function edit(User $user, Budget $budget): bool
    {
        return $budget->isOwnedBy($user);
    }

    public function inviteMember(User $user, Budget $budget): bool
    {
        return $budget->isOwnedBy($user);
    }

    public function setAsCurrent(User $user, Budget $budget): bool
    {
        return $budget->hasMember($user);
    }

    public function view(User $user, Budget $budget): bool
    {
        return $budget->hasMember($user);
    }

    public function viewAny(User $user): bool
    {
        return auth()->check();
    }
}
