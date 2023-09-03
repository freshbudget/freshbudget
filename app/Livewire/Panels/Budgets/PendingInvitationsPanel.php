<?php

namespace App\Livewire\Panels\Budgets;

use App\Models\Budget;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Url;
use Livewire\Component;

class PendingInvitationsPanel extends Component
{
    protected $listeners = ['invitationSent' => '$refresh'];

    #[Locked]
    public string $budgetUlid;

    #[Url(as: 'invitation')]
    public string $search = '';

    public function mount(string $budgetUlid)
    {
        $this->budgetUlid = $budgetUlid;
    }

    protected function budget(): Budget
    {
        return user()->joinedBudgets()->where('ulid', $this->budgetUlid)->firstOrFail();
    }

    protected function invitations()
    {
        return $this->budget()->invitations()->pending()->with(['sender'])
            ->when($this->search, function ($query) {
                $query
                    ->where('email', 'like', "%{$this->search}%")
                    ->where('name', 'like', "%{$this->search}%");
            })
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.panels.budgets.pending-invitations-panel', [
            'invitations' => $this->invitations(),
        ]);
    }
}
