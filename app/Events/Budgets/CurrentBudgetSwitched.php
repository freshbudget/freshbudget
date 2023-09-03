<?php

namespace App\Events\Budgets;

use App\Models\Budget;
use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CurrentBudgetSwitched
{
    use Dispatchable, SerializesModels;

    public function __construct(public User $user, public Budget $budget)
    {
        //
    }
}
