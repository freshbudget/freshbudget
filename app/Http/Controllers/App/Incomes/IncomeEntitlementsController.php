<?php

namespace App\Http\Controllers\App\Incomes;

use App\Domains\Budgets\Models\BudgetStatistic;
use App\Domains\Incomes\Models\Income;
use App\Domains\Incomes\Models\IncomeEntitlement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Stats\StatsWriter;

class IncomeEntitlementsController extends Controller
{
    public function create(Income $income)
    {
        $this->authorize('addEntitlements', [$income, currentBudget()]);

        return view('app.incomes.show.entitlements.create', [
            'income' => $income,
        ]);
    }

    public function edit(Income $income, IncomeEntitlement $entitlement)
    {
        $this->authorize('editEntitlements', [$income, currentBudget()]);

        return view('app.incomes.show.entitlements.edit', [
            'income' => $income,
            'entitlement' => $entitlement,
        ]);
    }

    public function show(Income $income)
    {
        $this->authorize('view', [$income, currentBudget()]);

        $income->load(['entitlements']);

        if ($income->entitlements->count() === 0) {
            return redirect()->route('app.incomes.entitlements.create', $income);
        }

        return view('app.incomes.show.entitlements.show', [
            'income' => $income,
        ]);
    }

    public function store(Income $income, Request $request)
    {
        $this->authorize('addEntitlements', [$income, currentBudget()]);

        $this->validate($request, [
            'entitlements' => ['required', 'array'],
            'entitlements.*.name' => ['required', 'string'],
            'entitlements.*.amount' => ['required', 'string'],
        ]);

        foreach ($request->entitlements as $entitlement) {

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

        $income->flush();

        $income->load(['entitlements']);

        foreach ($income->entitlements as $entitlement) {
            StatsWriter::for(BudgetStatistic::class, [
                'budget_id' => currentBudget()->id,
                'model_type' => IncomeEntitlement::class,
                'model_id' => $entitlement->id,
                'name' => $entitlement->name,
            ])->set($entitlement->amount);
        }

        return redirect()->route('app.incomes.entitlements.show', $income);
    }
}
