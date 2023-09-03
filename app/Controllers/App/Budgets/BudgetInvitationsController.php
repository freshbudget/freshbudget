<?php

namespace App\Controllers\App\Budgets;

use App\Models\Budget;
use App\Models\BudgetInvitation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class BudgetInvitationsController
{
    use AuthorizesRequests, ValidatesRequests;

    public function create(Budget $budget)
    {
        $this->authorize('inviteMember', $budget);

        return view('app.budgets.show.invite', [
            'budget' => $budget,
            'budgets' => user()->joinedBudgets()->orderBy('name')->get(),
        ]);
    }

    public function destroy(Budget $budget, BudgetInvitation $invitation)
    {
        $this->authorize('inviteMember', $budget);

        $invitation->delete();

        return redirect()->route('app.budgets.members.index', $budget);
    }
}
