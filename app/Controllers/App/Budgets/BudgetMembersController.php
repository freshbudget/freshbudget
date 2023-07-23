<?php

namespace App\Controllers\App\Budgets;

use App\Controllers\Controller;
use App\Domains\Budgets\Models\Budget;

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
