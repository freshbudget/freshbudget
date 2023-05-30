<?php

namespace App\Domains\Incomes\Presenters;

use Akaunting\Money\Currency;
use Akaunting\Money\Money;
use App\Domains\Incomes\Models\Income;

class IncomePresenter
{
    public function __construct(public Income $income)
    {
        //
    }

    public function estimatedNetPerPeriod(): string
    {
        $amount = $this->income->estimated_net_per_period;

        if (! $amount) {
            return new Money(0, new Currency($this->income->currency));
        }

        return new Money($this->income->estimated_net_per_period, new Currency($this->income->currency));
    }
}
