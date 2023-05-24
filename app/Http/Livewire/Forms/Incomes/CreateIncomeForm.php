<?php

namespace App\Http\Livewire\Forms\Incomes;

use Livewire\Component;
use Illuminate\Validation\Rules\Enum;
use App\Domains\Incomes\Models\IncomeType;
use App\Domains\Incomes\Enums\IncomeFrequency;

class CreateIncomeForm extends Component
{
    public $name = '';

    public $type_id = null;

    public $frequency = null;

    public $user_ulid;

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'type_id' => ['required', 'exists:income_types,id'],
            'frequency' => ['required', new Enum(IncomeFrequency::class)],
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
            'frequency' => $this->frequency,
        ]);

        if ($income->frequency->value === IncomeFrequency::ONE_TIME->value) {
            $income->update(['active' => false]);
        }

        $this->emit('incomeCreated');

        return redirect()->route('app.incomes.entitlements.create', $income);
    }

    public function render()
    {
        return view('livewire.forms.incomes.create-income-form', [
            'users' => currentBudget()->members()->orderBy('name')->select(['users.ulid', 'name'])->get(),
            'types' => IncomeType::orderBy('name')->select(['id', 'name'])->get(),
            'frequencies' => IncomeFrequency::cases(),
        ]);
    }
}
