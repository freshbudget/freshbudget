<?php

namespace App\Livewire\Panels\Incomes;

use App\Domains\Accounts\Models\Account;
use App\Domains\Incomes\Models\IncomeType;
use App\Domains\Shared\Enums\AccountType;
use App\Domains\Shared\Enums\Currency;
use App\Domains\Shared\Enums\Frequency;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rules\Enum;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CreateIncomePanel extends Component
{
    use AuthorizesRequests;

    #[Rule(['required', 'string', 'max:255'])]
    public $name = '';

    #[Rule(['required', 'exists:income_types,id'])]
    public $subtype_id = null;

    #[Rule(['required', new Enum(Frequency::class)])]
    public $frequency = null;

    #[Rule(['nullable', 'exists:users,ulid'])]
    public $user_ulid = null;

    public function attempt()
    {
        $this->authorize('create', [Account::class, currentBudget()]);

        $this->validate();

        $owner = currentBudget()->members()->where('ulid', $this->user_ulid)->first();

        $income = currentBudget()->incomes()->create([
            'user_id' => $owner?->id,
            'name' => $this->name,
            'type' => AccountType::REVENUE,
            'subtype_id' => $this->subtype_id,
            'currency' => Currency::USD,
            'frequency' => $this->frequency,
        ]);

        if ($income->frequency->value === Frequency::ONE_TIME->value) {
            $income->update(['active' => false]);
        }

        return redirect()->route('app.incomes.show', $income);
    }

    public function render()
    {
        return view('livewire.panels.incomes.create-income-panel', [
            'users' => currentBudget()->members()->orderBy('name')->select(['users.ulid', 'name'])->get(),
            'types' => IncomeType::orderBy('name')->select(['id', 'name'])->get(),
            'frequencies' => Frequency::cases(),
        ]);
    }
}
