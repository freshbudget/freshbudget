<?php

namespace App\Domains\Incomes\Actions;

use App\Domains\Incomes\Models\Income;
use App\Domains\Incomes\Models\IncomeEntitlement;
use Illuminate\Support\Arr;

class CreateIncomeEntitlementAction
{
    public IncomeEntitlement $entitlement;

    public function __construct(public Income $income, public array $data)
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

        // check if the entitlement already exists
        $existing = $this->income->entitlements()
            ->where('name', $name)
            ->where('active', true)
            ->first();

        // if it does, we need to deactivate it, and set the end date
        if ($existing) {
            (new DeactivateIncomeEntitlementAction($existing))->execute(now());
        }

        // create the new entitlement, and set the previous id if it exists
        $this->entitlement = $this->income->entitlements()->create([
            'name' => $name,
            'amount' => $amount,
            'start_date' => now(),
            'active' => Arr::get($this->data, 'active', true),
            'previous_id' => $existing?->id,
            'change_reason' => $existing ? Arr::get($this->data, 'change_reason', '') : null,
        ]);

        return $this->entitlement;
    }
}
