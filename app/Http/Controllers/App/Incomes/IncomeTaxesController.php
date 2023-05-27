<?php

namespace App\Http\Controllers\App\Incomes;

use App\Domains\Incomes\Models\Income;
use App\Domains\Incomes\Models\IncomeTax;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IncomeTaxesController extends Controller
{
    public function create(Income $income)
    {
        $this->authorize('addTaxes', [$income, currentBudget()]);

        return view('app.incomes.show.taxes.create', [
            'income' => currentBudget()->incomes()->findOrFail($income->id),
        ]);
    }

    public function store(Income $income, Request $request)
    {
        $this->authorize('addTaxes', [$income, currentBudget()]);

        // TODO: validate the request

        // loop over each entitlement and create it
        $taxes = $request->taxes;

        foreach ($taxes as $tax) {

            $amount = $tax['amount'];

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

            IncomeTax::create([
                'income_id' => $income->id,
                'name' => $tax['name'],
                'amount' => $amount,
                'start_date' => now(),
                'end_date' => null,
            ]);
        }

        return redirect()->route('app.incomes.show', $income);
    }
}
