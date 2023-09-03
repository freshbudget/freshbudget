<?php

namespace App\Actions\User;

use App\Events\Budgets\CurrentBudgetSwitched;
use App\Exceptions\CannotAccessABudgetYouDontBelongTo;
use App\Models\Budget;
use App\Models\User;

class SwitchCurrentBudgetAction
{
    public function execute(User $user, Budget $budget): User
    {
        if (! $budget->hasMember($user)) {
            throw new CannotAccessABudgetYouDontBelongTo();
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
