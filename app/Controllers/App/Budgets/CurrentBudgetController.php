<?php

namespace App\Controllers\App\Budgets;

use App\Models\Budget;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class CurrentBudgetController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __invoke(Budget $budget)
    {
        $this->authorize('setAsCurrent', $budget);

        user()->switchCurrentBudget($budget);

        return back(fallback: route('app.index'));
    }
}
