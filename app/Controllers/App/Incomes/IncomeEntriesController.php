<?php

namespace App\Controllers\App\Incomes;

use App\Domains\Incomes\Models\Income;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class IncomeEntriesController
{
    use AuthorizesRequests, ValidatesRequests;

    public function create(Income $income)
    {
        $this->authorize('addEntry', [$income, currentBudget()]);

        $income->load(['entitlements', 'taxes', 'deductions']);

        return view('app.incomes.show.entries.create', [
            'income' => $income,
        ]);
    }
}
