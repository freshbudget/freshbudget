<?php

namespace App\Http\Controllers\App\Incomes;

use App\Domains\Incomes\Actions\CreateIncomeDeductionAction;
use App\Domains\Incomes\Actions\UpdateIncomeDeductionEstimate;
use App\Domains\Incomes\Actions\UpdateIncomeNetEstimate;
use App\Domains\Incomes\Models\Income;
use App\Domains\Incomes\Models\IncomeStatistic;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Stats\StatsWriter;

class IncomeDeductionsController extends Controller
{
    public function create(Income $income)
    {
        $this->authorize('addDeductions', [$income, currentBudget()]);

        return view('app.incomes.show.deductions.create', [
            'income' => currentBudget()->incomes()->findOrFail($income->id),
        ]);
    }

    public function show(Income $income)
    {
        $this->authorize('view', [$income, currentBudget()]);

        $deductions = $income->deductions()->orderBy('name')->get();

        if ($deductions->count() === 0) {
            return redirect()->route('app.incomes.deductions.create', $income);
        }

        return view('app.incomes.show.deductions.show', [
            'income' => $income,
            'deductions' => $deductions,
        ]);
    }

    public function store(Income $income, Request $request)
    {
        $this->authorize('addDeductions', [$income, currentBudget()]);

        $this->validate($request, [
            'deductions' => ['required', 'array'],
            'deductions.*.name' => ['required', 'string'],
            'deductions.*.amount' => ['required', 'string'],
        ]);

        foreach ($request->deductions as $deduction) {
            (new CreateIncomeDeductionAction(
                income: $income,
                data: $deduction,
            ))->execute();
        }

        (new UpdateIncomeDeductionEstimate($income))->execute();

        (new UpdateIncomeNetEstimate($income))->execute();

        StatsWriter::for(IncomeStatistic::class, [
            'income_id' => $income->id,
            'name' => 'estimated_deductions_per_period',
        ])->set($income->estimated_deductions_per_period);

        return redirect()->route('app.incomes.show', $income);
    }
}
