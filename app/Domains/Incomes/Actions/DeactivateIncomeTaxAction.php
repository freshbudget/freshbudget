<?php

namespace App\Domains\Incomes\Actions;

use App\Domains\Incomes\Models\IncomeTax;

class DeactivateIncomeTaxAction
{
    public function __construct(public IncomeTax $tax)
    {
        //
    }

    public function execute($timestamp = null): void
    {
        $this->tax->update([
            'active' => false,
            'end_date' => $timestamp ?? now(),
        ]);
    }
}
