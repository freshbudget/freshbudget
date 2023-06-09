<?php

namespace App\Domains\Incomes\Actions;

use App\Domains\Incomes\Models\Income;
use App\Domains\Incomes\Models\IncomeDeduction;
use Illuminate\Support\Arr;

class CreateIncomeDeductionAction
{
    public IncomeDeduction $deduction;

    public function __construct(public Income $income, public array $data)
    {
        //
    }

    public function execute(): IncomeDeduction
    {
        // clean up the amount and convert to cents
        $amount = (int) abs(str($this->data['amount'])
            ->replace(',', '')
            ->replace('$', '')
            ->toFloat()
            * 100);

        // clean up the name
        $name = str($this->data['name'])->trim()->toString();

        // check if the tax already exists
        $existing = $this->income->deductions()
            ->where('name', $name)
            ->where('active', true)
            ->first();

        // if it does, we need to deactivate it, and set the end date
        if ($existing) {
            (new DeactivateIncomeDeductionAction($existing))->execute(now());
        }

        // create the new tax, and set the previous id if it exists
        $this->deduction = $this->income->deductions()->create([
            'name' => $name,
            'amount' => $amount,
            'start_date' => Arr::get($this->data, 'start_date', now()),
            'active' => Arr::get($this->data, 'active', true),
            //'previous_id' => $existing?->id,
            'change_reason' => $existing ? Arr::get($this->data, 'change_reason', '') : null,
        ]);

        return $this->deduction;
    }
}
