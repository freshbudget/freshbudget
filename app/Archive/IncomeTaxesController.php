<?php

namespace App\Controllers\App\Incomes;

use App\Domains\Incomes\Actions\CreateIncomeTaxAction;
use App\Domains\Incomes\Actions\UpdateIncomeNetEstimate;
use App\Domains\Incomes\Actions\UpdateIncomeTaxEstimate;
use App\Domains\Incomes\Models\Income;
use App\Domains\Incomes\Models\IncomeStatistic;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Spatie\Stats\StatsWriter;

class IncomeTaxesController
{
    use AuthorizesRequests, ValidatesRequests;

    public function create(Income $income)
    {
        $this->authorize('addTaxes', [$income, currentBudget()]);

        return view('app.incomes.show.taxes.create', [
            'income' => $income,
        ]);
    }

    public function show(Income $income)
    {
        $this->authorize('view', [$income, currentBudget()]);

        $taxes = $income->taxes()->orderBy('name')->get();

        if ($taxes->count() === 0) {
            return redirect()->route('app.incomes.taxes.create', $income);
        }

        return view('app.incomes.show.taxes.show', [
            'income' => $income,
            'taxes' => $taxes,
        ]);
    }

    public function store(Income $income, Request $request)
    {
        $this->authorize('addTaxes', [$income, currentBudget()]);

        $this->validate($request, [
            'taxes' => ['required', 'array'],
            'taxes.*.name' => ['required', 'string'],
            'taxes.*.amount' => ['required', 'string'],
        ]);

        foreach ($request->taxes as $tax) {
            (new CreateIncomeTaxAction(
                income: $income,
                data: $tax,
            ))->execute();
        }

        (new UpdateIncomeTaxEstimate($income))->execute();

        (new UpdateIncomeNetEstimate($income))->execute();

        StatsWriter::for(IncomeStatistic::class, [
            'income_id' => $income->id,
            'name' => 'estimated_taxes_per_period',
        ])->set($income->estimated_taxes_per_period);

        return redirect()->route('app.incomes.show', $income);
    }
}
