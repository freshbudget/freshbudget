<?php

namespace App\Domains\Incomes\Actions;

use App\Domains\Incomes\Models\Income;
use App\Domains\Incomes\Models\IncomeTax;

class UpdateIncomeTaxEstimate
{
    public function __construct(public Income $income)
    {
        //
    }

    public function execute(): void
    {
        $total = 0;

        $taxes = $this->income->taxes()
            ->where('active', true)
            ->get();

        $taxes->each(function (IncomeTax $tax) use (&$total) {
            $total += $tax->amount;
        });

        $this->income->update([
            'estimated_taxes_per_period' => $total,
        ]);
    }
}
