<?php

namespace App\Http\Controllers\App\Incomes;

use App\Domains\Incomes\Models\Income;
use App\Domains\Incomes\Models\IncomeDeduction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IncomeDeductionsController extends Controller
{
    public function create(Income $income)
    {
        $this->authorize('addDeductions', [$income, currentBudget()]);

        return view('app.incomes.show.deductions.create', [
            'incomes' => currentBudget()->incomes()->orderBy('name')->get(),
            'income' => currentBudget()->incomes()->findOrFail($income->id),
        ]);
    }

    public function store(Income $income, Request $request)
    {
        $this->authorize('addDeductions', [$income, currentBudget()]);

        // TODO: validate the request

        // loop over each entitlement and create it
        $deductions = $request->deductions;

        foreach ($deductions as $deduction) {

            $amount = $deduction['amount'];

            // need to strip any commas from the amount
            $amount = str_replace(',', '', $amount);

            // need to strip any dollar signs from the amount
            $amount = str_replace('$', '', $amount);

            // need to convert to a php float
            $amount = (float) $amount;

            // need to convert to cents
            $amount = $amount * 100;

            // need to convert to an integer
            $amount = (int) $amount;

            IncomeDeduction::create([
                'income_id' => $income->id,
                'name' => $deduction['name'],
                'amount' => $amount,
                'start_date' => now(),
                'end_date' => null,
            ]);
        }

        return redirect()->route('app.incomes.show', $income);
    }
}
