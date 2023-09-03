<?php

namespace App\Domains\Incomes\Presenters;

use Akaunting\Money\Currency;
use Akaunting\Money\Money;
use App\Models\Income;

class IncomePresenter
{
    public function __construct(public Income $income)
    {
        //
    }

    public function estimatedDeductionsPerPeriod(): string
    {
        return $this->getFormattedAmount($this->income->estimated_deductions_per_period);
    }

    public function estimatedEntitlementsPerPeriod(): string
    {
        return $this->getFormattedAmount($this->income->estimated_entitlements_per_period);
    }

    public function estimatedNetPerPeriod(): string
    {
        return $this->getFormattedAmount($this->income->estimated_net_per_period);
    }

    public function estimatedTaxesPerPeriod(): string
    {
        return $this->getFormattedAmount($this->income->estimated_taxes_per_period);
    }

    public function getFormattedAmount($amount): string
    {
        if (! $amount) {
            return new Money(0, new Currency($this->income->currency));
        }

        return new Money($amount, new Currency($this->income->currency));
    }
}
