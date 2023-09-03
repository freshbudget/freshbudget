<?php

namespace App\Events\Budgets;

use App\Models\Budget;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BudgetDeleted
{
    use Dispatchable, SerializesModels;

    public function __construct(public Budget $budget)
    {
        //
    }
}
