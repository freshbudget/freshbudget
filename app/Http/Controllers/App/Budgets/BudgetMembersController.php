<?php

namespace App\Http\Controllers\App\Budgets;

use App\Domains\Budgets\Models\Budget;
use App\Http\Controllers\Controller;

class BudgetMembersController extends Controller
{
    public function index(Budget $budget)
    {
        $budget->load(['members', 'invitations.sender']);

        return view('app.budgets.show.members', [
            'budget' => $budget,
        ]);
    }
}
