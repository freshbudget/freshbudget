<?php

namespace App\Domains\Incomes\Presenters;

use Akaunting\Money\Currency;
use Akaunting\Money\Money;
use App\Domains\Incomes\Models\IncomeTax;

class IncomeTaxPresenter
{
    public function __construct(public IncomeTax $tax)
    {
        //
    }

    public function amount(): string
    {
        $amount = $this->tax->amount;

        if (! $amount) {
            return new Money(0, new Currency($this->tax->income->currency));
        }

        return new Money($this->tax->amount, new Currency($this->tax->income->currency));
    }
}
