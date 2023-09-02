<?php

namespace App\Domains\Incomes\Actions;

use App\Domains\Incomes\Models\Income;

class UpdateIncomeDeductionEstimate
{
    public function __construct(public Income $income)
    {
        //
    }

    public function execute(): void
    {
        $total = $this->income->activeDeductions()->sum('amount');

        $this->income->update([
            'estimated_deductions_per_period' => $total,
        ]);
    }
}
