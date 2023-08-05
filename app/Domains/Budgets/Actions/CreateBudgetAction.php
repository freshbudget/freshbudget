<?php

namespace App\Domains\Budgets\Actions;

use App\Domains\Budgets\Data\BudgetData;
use App\Domains\Budgets\Models\Budget;
use Spatie\QueueableAction\QueueableAction;

class CreateBudgetAction
{
    use QueueableAction;

    public function execute(BudgetData $data): Budget
    {
        return $data->owner->ownedBudgets()->create($data->toArray());
    }
}
