<?php

namespace App\Controllers\App\Budgets;

use App\Domains\Budgets\Models\Budget;
use App\Domains\Budgets\Models\BudgetInvitation;
use App\Domains\Users\Actions\SendBudgetInvitationAction;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

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

    public function store(Budget $budget, Request $request)
    {
        $this->authorize('inviteMember', $budget);

        $validated = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'nickname' => ['nullable', 'string', 'max:255'],
            'email' => [
                'required', 'email', 'max:255',
                Rule::unique('budget_invitations')->where(fn (Builder $query) => $query->where('budget_id', $budget->id)->where('email', $request->email)),
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

    public function destroy(Budget $budget, BudgetInvitation $invitation)
    {
        $this->authorize('inviteMember', $budget);

        $invitation->delete();

        return redirect()->route('app.budgets.members.index', $budget);
    }
}
