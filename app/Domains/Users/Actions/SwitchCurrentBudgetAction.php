<?php

namespace App\Domains\Users\Actions;

use App\Domains\Users\Models\User;
use App\Domains\Budgets\Models\Budget;
use App\Domains\Budgets\Events\CurrentBudgetSwitched;

class SwitchCurrentBudgetAction
{
    public function execute(User $user, Budget $budget): User
    {
        // ensure the user is a member of the budget
        if (!$user->belongsToBudget($budget)) {
            throw new \Exception('Cannot switch to a budget that you are not a member of.');
        }

        $user->update([
            'current_budget_id' => $budget->id,
        ]);

        // set the currentBudget relationship to the new budget
        $user->setRelation('currentBudget', $budget);

        // fire the event
        event(new CurrentBudgetSwitched($user, $budget));

        return $user;
    }
}