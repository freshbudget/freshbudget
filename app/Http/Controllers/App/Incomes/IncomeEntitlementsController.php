<?php

namespace App\Http\Controllers\App\Incomes;

use App\Domains\Incomes\Actions\CreateIncomeEntitlementAction;
use App\Domains\Incomes\Actions\UpdateIncomeEntitlementEstimate;
use App\Domains\Incomes\Actions\UpdateIncomeNetEstimate;
use App\Domains\Incomes\Models\Income;
use App\Domains\Incomes\Models\IncomeEntitlement;
use App\Domains\Incomes\Models\IncomeStatistic;
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

        $entitlements = $income->entitlements()->where('active', true)->orderBy('name')->get();

        if ($entitlements->count() === 0) {
            return redirect()->route('app.incomes.entitlements.create', $income);
        }

        return view('app.incomes.show.entitlements.show', [
            'income' => $income,
            'entitlements' => $entitlements,
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
            (new CreateIncomeEntitlementAction(
                income: $income,
                data: $entitlement,
            ))->execute();
        }

        (new UpdateIncomeEntitlementEstimate($income))->execute();

        (new UpdateIncomeNetEstimate($income))->execute();

        StatsWriter::for(IncomeStatistic::class, [
            'income_id' => $income->id,
            'name' => 'estimated_entitlements_per_period',
        ])->set($income->estimated_entitlements_per_period);

        return redirect()->route('app.incomes.entitlements.show', $income);
    }
}
