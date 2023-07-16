<?php

namespace App\Http\Controllers\App\Budgets;

use App\Domains\Budgets\Models\Budget;
use App\Domains\Users\Actions\SendBudgetInvitationAction;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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
            'email' => [
                'required', 'email', 'max:255', 
                Rule::unique('budget_invitations')->where(fn (Builder $query) => $query->where('budget_id', $budget->id)->where('email', $request->email))        
            ],
        ], [
            'email.unique' => 'That email has already been invited.',
        ]);

        // check if the user is already a member
        if ($budget->invitations()->where('email', $validated['email'])->exists()) {
            return redirect()->route('app.budgets.members.index', $budget);
        }

        (new SendBudgetInvitationAction(
            budget: $budget,
            sender: user(),
            email: $validated['email'],
            name: $validated['name'],
            nickname: Arr::get($validated, 'nickname', null),
        ))->execute();

        return redirect()->route('app.budgets.members.index', $budget);
    }
}
