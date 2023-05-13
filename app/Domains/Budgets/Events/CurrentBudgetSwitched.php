<?php

namespace App\Domains\Budgets\Events;

use App\Domains\Budgets\Models\Budget;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CurrentBudgetSwitched
{
    use Dispatchable, SerializesModels;

    public function __construct(public Budget $budget)
    {
        //
    }
}
