<?php

namespace App\Domains\Incomes\Listeners;

use App\Domains\Incomes\Models\Income;

class IncomeForceDeleted
{
    public function __construct(public Income $income)
    {
        //
    }

    public function handle(): void
    {
        // delete all versions of the income entitlments
        $this->income->entitlements()->versions()->delete();
    }
}
