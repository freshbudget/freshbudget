<?php

namespace App\Http\Controllers\App\Incomes;

use App\Domains\Incomes\Models\Income;
use App\Http\Controllers\Controller;

class IncomeEntriesController extends Controller
{
    public function create(Income $income)
    {
        $this->authorize('addEntry', [$income, currentBudget()]);

        $income->load(['entitlements', 'taxes', 'deductions']);

        return view('app.incomes.show.entries.create', [
            'income' => $income,
        ]);
    }
}
