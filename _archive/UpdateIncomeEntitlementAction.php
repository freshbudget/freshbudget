<?php

namespace App\Domains\Incomes\Actions;

use App\Domains\Incomes\Models\IncomeEntitlement;
use Illuminate\Support\Arr;

class UpdateIncomeEntitlementAction
{
    public function __construct(public IncomeEntitlement $entitlement, public array $data)
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
        $name = str($this->data['name'] ?? $this->entitlement->name)->trim()->toString();

        $this->entitlement->disableVersioning();

        $this->entitlement->update([
            'end_date' => Arr::get($this->data, 'end_date', $this->entitlement->end_date),
        ]);

        $this->entitlement->enableVersioning();

        $this->entitlement->update([
            'name' => $name,
            'amount' => $amount,
            'start_date' => Arr::get($this->data, 'start_date', $this->entitlement->start_date),
            'end_date' => Arr::get($this->data, 'end_date', $this->entitlement->end_date),
            'reason' => Arr::get($this->data, 'reason', ''),
        ]);

        return $this->entitlement;
    }
}
