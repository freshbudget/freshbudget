<?php

namespace App\Livewire\Panels\Budgets;

use App\Domains\Budgets\Models\Budget;
use App\Domains\Users\Actions\SendBudgetInvitationAction;
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;
use Livewire\Component;

class InviteMemberPanel extends Component
{
    public string $name = '';

    public string $email = '';

    public string $role = 'member';

    public string $budgetUlid;

    public function mount(string $budgetUlid)
    {
        $this->budgetUlid = $budgetUlid;
    }

    protected function budget(): Budget
    {
        return user()->joinedBudgets()->where('ulid', $this->budgetUlid)->firstOrFail();
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255',
                Rule::unique('budget_invitations')->where(fn (Builder $query) => $query
                    ->where('budget_id', $this->budget()->id)->where('email', $this->email)),
            ],
            'role' => ['required', 'string', 'max:255', Rule::in(['member', 'admin', 'persona'])],
        ];
    }

    public function attempt()
    {
        $this->authorize('inviteMember', currentBudget());

        $this->validate();

        $budget = $this->budget();

        if ($budget->invitations()->where('email', $this->email)->exists()) {
            return redirect()->route('app.budgets.members.index', $budget);
        }

        (new SendBudgetInvitationAction(
            budget: $budget,
            sender: user(),
            email: $this->email,
            role: $this->role,
            name: $this->name,
        ))->execute();

        $this->reset(['name', 'email', 'role']);

        $this->dispatch('invitationSent');
    }

    public function render()
    {
        return view('livewire.panels.budgets.invite-member-panel');
    }
}
