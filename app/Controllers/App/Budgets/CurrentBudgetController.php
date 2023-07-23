<?php

namespace App\Controllers\App\Budgets;

use App\Controllers\Controller;
use App\Domains\Budgets\Models\Budget;

class CurrentBudgetController extends Controller
{
    public function __invoke(Budget $budget)
    {
        $this->authorize('setAsCurrent', $budget);

        user()->switchCurrentBudget($budget);

        return back(fallback: route('app.index'));
    }
}
