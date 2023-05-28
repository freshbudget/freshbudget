<?php

namespace App\Domains\Incomes\Events;

use App\Domains\Incomes\Models\Income;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class IncomeCreated
{
    use Dispatchable, SerializesModels;

    public function __construct(public Income $income)
    {
        //
    }
}
