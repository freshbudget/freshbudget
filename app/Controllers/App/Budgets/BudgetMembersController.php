<?php

namespace App\Controllers\App\Budgets;

use App\Models\Budget;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class BudgetMembersController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index(Budget $budget)
    {
        $budget->load(['members', 'invitations.sender']);

        return view('app.budgets.show.members', [
            'budget' => $budget,
        ]);
    }
}
