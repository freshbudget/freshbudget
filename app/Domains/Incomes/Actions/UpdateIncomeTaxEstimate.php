<?php

namespace App\Domains\Incomes\Actions;

use App\Domains\Incomes\Models\Income;

class UpdateIncomeTaxEstimate
{
    public function __construct(public Income $income)
    {
        //
    }

    public function execute(): void
    {
        $total = $this->income->activeTaxes()->sum('amount');

        $this->income->update([
            'estimated_taxes_per_period' => $total,
        ]);
    }
}
