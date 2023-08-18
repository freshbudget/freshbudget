<?php

namespace App\Domains\Users\Actions;

use App\Domains\Budgets\Events\CurrentBudgetSwitched;
use App\Domains\Budgets\Models\Budget;
use App\Domains\Users\Exceptions\CannotAccessABudgetYouDontBelongTo;
use App\Domains\Users\Models\User;

class SwitchCurrentBudgetAction
{
    public function execute(User $user, Budget $budget): User
    {
        if(!$budget->hasMember($user)) {
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
