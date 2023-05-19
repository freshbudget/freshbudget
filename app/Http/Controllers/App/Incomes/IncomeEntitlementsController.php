<?php

namespace App\Http\Controllers\App\Incomes;

use App\Domains\Incomes\Models\Income;
use App\Domains\Incomes\Models\IncomeEntitlement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IncomeEntitlementsController extends Controller
{
    public function create(Income $income)
    {
        return view('app.incomes.show.entitlements.create', [
            'incomes' => currentBudget()->incomes()->orderBy('name')->get(),
            'income' => currentBudget()->incomes()->findOrFail($income->id),
        ]);
    }

    public function store(Income $income, Request $request)
    {
        // loop over each entitlement and create it
        $entitlements = $request->entitlements;

        foreach ($entitlements as $entitlement) {

            $amount = $entitlement['amount'];

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

            IncomeEntitlement::create([
                'income_id' => $income->id,
                'name' => $entitlement['name'],
                'amount' => $amount,
                'start_date' => now(),
                'end_date' => null,
            ]);
        }

        return redirect()->route('app.incomes.show', $income);
    }
}
