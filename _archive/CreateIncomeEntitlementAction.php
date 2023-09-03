<?php

namespace App\Domains\Incomes\Actions;

use App\Domains\Incomes\Models\IncomeEntitlement;
use App\Models\Account;
use Illuminate\Support\Arr;

class CreateIncomeEntitlementAction
{
    public IncomeEntitlement $entitlement;

    public function __construct(public Account $income, public array $data)
    {
        //
    }

    public function execute(): IncomeEntitlement
    {
        // clean up the amount and convert to cents
        $amount = (int) abs(str($this->data['amount'])
            ->replace(',', '')
            ->replace('$', '')
            ->toFloat()
            * 100);

        // clean up the name
        $name = str($this->data['name'])->trim()->toString();

        $this->entitlement = $this->income->entitlements()->create([
            'name' => $name,
            'amount' => $amount,
            'start_date' => Arr::get($this->data, 'start_date', now()),
            'end_date' => Arr::get($this->data, 'end_date', null),
            'reason' => Arr::get($this->data, 'reason', 'Initial entitlement'),
        ]);

        return $this->entitlement;
    }
}
