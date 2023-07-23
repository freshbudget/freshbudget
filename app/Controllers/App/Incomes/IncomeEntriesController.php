<?php

namespace App\Controllers\App\Incomes;

use App\Controllers\Controller;
use App\Domains\Incomes\Models\Income;

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
