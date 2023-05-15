<?php

namespace App\Http\Controllers\App\Budgets;

use App\Domains\Budgets\Models\Budget;
use App\Http\Controllers\Controller;

class CurrentBudgetController extends Controller
{
    public function __invoke(Budget $budget)
    {
        $this->authorize('setAsCurrent', $budget);

        user()->switchCurrentBudget($budget);

        return back(fallback: route('app.index'));
    }
}
