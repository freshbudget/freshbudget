<?php

namespace App\Domains\Incomes\Actions;

use App\Domains\Incomes\Models\IncomeEntitlement;

class DeactivateIncomeEntitlementAction
{
    public function __construct(public IncomeEntitlement $entitlement)
    {
        //
    }

    public function execute($timestamp = null): void
    {
        $this->entitlement->update([
            'active' => false,
            'end_date' => $timestamp ?? now(),
        ]);
    }
}
