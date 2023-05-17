<?php

namespace App\Domains\Budgets\Events;

use App\Domains\Users\Models\User;
use App\Domains\Budgets\Models\Budget;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class CurrentBudgetSwitched
{
    use Dispatchable, SerializesModels;

    public function __construct(User $user, public Budget $budget)
    {
        //
    }
}
