<?php

namespace App\Livewire\Panels\Expenses;

use App\Enums\Currency;
use App\Models\Account;
use App\Models\ExpenseType;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CreateExpensePanel extends Component
{
    use AuthorizesRequests;

    #[Rule(['required', 'string', 'max:255'])]
    public $name = '';

    #[Rule(['required', 'exists:asset_account_types,id'])]
    public $subtype_id = null;

    #[Rule(['nullable', 'exists:users,ulid'])]
    public $user_ulid = null;

    public function attempt()
    {
        $this->authorize('create', [Account::class, currentBudget()]);

        $this->validate();

        $owner = currentBudget()->members()->where('ulid', $this->user_ulid)->first();

        $expense = currentBudget()->expenses()->create([
            'user_id' => $owner?->id,
            'name' => $this->name,
            'subtype_id' => $this->subtype_id,
            'currency' => Currency::USD,
        ]);

        return redirect()->route('app.expenses.show', $expense);
    }

    public function render()
    {
        return view('livewire.panels.expenses.create', [
            'users' => currentBudget()->members()->orderBy('name')->select(['users.ulid', 'name'])->get(),
            'types' => ExpenseType::orderBy('name')->select(['id', 'name'])->get(),
        ]);
    }
}
