<?php

namespace App\Domains\Incomes\Actions;

use App\Domains\Incomes\Models\Income;
use App\Domains\Incomes\Models\IncomeDeduction;

class UpdateIncomeDeductionEstimate
{
    public function __construct(public Income $income)
    {
        //
    }

    public function execute(): void
    {
        $total = 0;

        $deductions = $this->income->deductions()
            ->where('active', true)
            ->get();

        $deductions->each(function (IncomeDeduction $deduction) use (&$total) {
            $total += $deduction->amount;
        });

        $this->income->update([
            'estimated_deductions_per_period' => $total,
        ]);
    }
}
