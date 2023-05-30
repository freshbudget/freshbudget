<?php 

namespace App\Http\Controllers\App\Budgets;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domains\Budgets\Models\Budget;
use App\Domains\Users\Actions\SendBudgetInvitationAction;

class BudgetInvitationsController extends Controller
{
    public function create(Budget $budget)
    {
        $this->authorize('inviteMember', $budget);

        return view('app.budgets.show.invite', [
            'budget' => $budget,
            'budgets' => user()->joinedBudgets()->orderBy('name')->get(),
        ]);
    }

    public function store(Budget $budget, Request $request)
    {
        $this->authorize('inviteMember', $budget);

        $validated = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'nickname' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
        ]);

        (new SendBudgetInvitationAction(
            budget: $budget,
            sender: user(),
            email: $validated['email'],
            name: $validated['name'],
            nickname: Arr::get($validated, 'nickname', null),
        ))->execute();
        
        return redirect()->route('app.budgets.show', $budget);
    }
}