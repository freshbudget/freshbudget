<?php

namespace App\Domains\Incomes\Actions;

use App\Domains\Incomes\Models\Income;

class UpdateIncomeEntitlementEstimate
{
    public function __construct(public Income $income)
    {
        //
    }

    public function execute(): void
    {
        $total = $this->income->entitlements()->sum('amount');

        $this->income->update([
            'estimated_entitlements_per_period' => $total,
        ]);
    }
}
