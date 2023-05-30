<?php

namespace App\Http\Controllers\App\Incomes;

use App\Domains\Incomes\Actions\CreateIncomeTaxAction;
use App\Domains\Incomes\Actions\UpdateIncomeTaxEstimate;
use App\Domains\Incomes\Models\Income;
use App\Domains\Incomes\Models\IncomeStatistic;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Stats\StatsWriter;

class IncomeTaxesController extends Controller
{
    public function create(Income $income)
    {
        $this->authorize('addTaxes', [$income, currentBudget()]);

        return view('app.incomes.show.taxes.create', [
            'income' => $income,
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

        StatsWriter::for(IncomeStatistic::class, [
            'income_id' => $income->id,
            'name' => 'estimated_taxes_per_period',
        ])->set($income->estimated_taxes_per_period);

        return redirect()->route('app.incomes.show', $income);
    }
}
