<?php

namespace App\Domains\Budgets\Events;

use App\Domains\Budgets\Models\Budget;
use App\Domains\Users\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CurrentBudgetSwitched
{
    use Dispatchable, SerializesModels;

    public function __construct(User $user, public Budget $budget)
    {
        //
    }
}
