<?php

namespace App\Domains\Incomes\Actions;

use App\Domains\Incomes\Models\Income;

class UpdateIncomeNetEstimate
{
    public function __construct(public Income $income)
    {
        //
    }

    public function execute(): void
    {
        $entitlements = $this->income->activeEntitlements()->sum('amount');

        $taxes = $this->income->activeTaxes()->sum('amount');

        $deductions = $this->income->activeDeductions()->sum('amount');

        $total = $entitlements - $taxes - $deductions;

        $this->income->update([
            'estimated_net_per_period' => $total,
        ]);
    }
}
