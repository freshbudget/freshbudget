<?php

namespace App\Domains\Incomes\Actions;

use App\Domains\Incomes\Models\IncomeDeduction;

class DeactivateIncomeDeductionAction
{
    public function __construct(public IncomeDeduction $deduction)
    {
        //
    }

    public function execute($timestamp = null): void
    {
        $this->deduction->update([
            'end_date' => $timestamp ?? now(),
        ]);
    }
}
