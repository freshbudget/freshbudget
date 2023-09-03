<?php

namespace App\Events\Budgets;

use App\Models\Budget;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BudgetCreated
{
    use Dispatchable, SerializesModels;

    public function __construct(public Budget $budget)
    {
        //
    }
}
