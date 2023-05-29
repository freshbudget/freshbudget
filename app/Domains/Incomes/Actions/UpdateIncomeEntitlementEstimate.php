<?php

namespace App\Domains\Incomes\Actions;

use App\Domains\Incomes\Models\Income;
use App\Domains\Incomes\Models\IncomeEntitlement;

class UpdateIncomeEntitlementEstimate
{
    public function __construct(public Income $income)
    {
        //
    }

    public function execute(): void
    {
        $total = 0;

        $entitlements = $this->income->entitlements()
            ->where('active', true)
            ->get();

        $entitlements->each(function (IncomeEntitlement $entitlement) use (&$total) {
            $total += $entitlement->amount;
        });

        $this->income->update([
            'estimated_entitlements_per_period' => $total,
        ]);
    }
}
