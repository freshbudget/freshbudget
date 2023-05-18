<?php

namespace App\Http\Livewire\Forms\Incomes;

use App\Domains\Incomes\Models\IncomeFrequency;
use App\Domains\Incomes\Models\IncomeType;
use Livewire\Component;

class CreateIncomeForm extends Component
{
    public $name = '';

    public $type_id = null;

    public $frequency_id = null;

    public $user_ulid;

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'type_id' => ['required', 'exists:income_types,id'],
            'frequency_id' => ['required', 'exists:income_frequencies,id'],
            'user_ulid' => ['nullable', 'exists:users,ulid'],
        ];
    }

    public function attempt()
    {
        $this->validate();

        $owner = currentBudget()->members()->where('ulid', $this->user_ulid)->first();

        $income = currentBudget()->incomes()->create([
            'user_id' => $owner->id ?: null,
            'name' => $this->name,
            'type_id' => $this->type_id,
            'frequency_id' => $this->frequency_id,
        ]);

        $this->emit('incomeCreated');

        return redirect()->route('app.incomes.entitlements.create', $income);
    }

    public function render()
    {
        return view('livewire.forms.incomes.create-income-form', [
            'users' => currentBudget()->members()->orderBy('name')->select(['users.ulid', 'name'])->get(),
            'types' => IncomeType::orderBy('name')->select(['id', 'name'])->get(),
            'frequencies' => IncomeFrequency::orderBy('name')->select(['id', 'name'])->get(),
        ]);
    }
}
