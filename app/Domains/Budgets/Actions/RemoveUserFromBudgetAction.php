<?php

namespace App\Domains\Budgets\Actions;

use App\Domains\Budgets\Models\Budget;
use App\Domains\Users\Models\User;

class RemoveUserFromBudgetAction
{
    public function __construct(public Budget $budget, public User $user)
    {
        //
    }

    public function execute()
    {
        // check if they are the owner of any incomes in the budget, if so set to null
        $this->budget->incomes()->where('user_id', $this->user->id)->update([
            'user_id' => null,
        ]);

        // Remove the user from the budget
        $this->budget->removeMember($this->user);
    }
}
