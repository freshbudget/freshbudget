<?php

namespace App\Livewire\Forms\Incomes;

use App\Domains\Incomes\Models\IncomeType;
use App\Domains\Shared\Enums\Frequency;
use Illuminate\Validation\Rules\Enum;
use Livewire\Attributes\Locked;
use Livewire\Component;

class CreateIncomeForm extends Component
{
    public $name = '';

    public $type_id = null;

    public $frequency = null;

    #[Locked]
    public $user_ulid = null;

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'type_id' => ['required', 'exists:income_types,id'],
            'frequency' => ['required', new Enum(Frequency::class)],
            'user_ulid' => ['nullable', 'exists:users,ulid'],
        ];
    }

    public function attempt()
    {
        $this->validate();

        $owner = currentBudget()->members()->where('ulid', $this->user_ulid)->first();

        $income = currentBudget()->incomes()->create([
            'user_id' => $owner?->id,
            'name' => $this->name,
            'type_id' => $this->type_id,
            'frequency' => $this->frequency,
        ]);

        if ($income->frequency->value === Frequency::ONE_TIME->value) {
            $income->update(['active' => false]);
        }

        return $this->redirect(route('app.incomes.entitlements.create', $income), true);
    }

    public function render()
    {
        return view('livewire.forms.incomes.create-income-form', [
            'users' => currentBudget()->members()->orderBy('name')->select(['users.ulid', 'name'])->get(),
            'types' => IncomeType::orderBy('name')->select(['id', 'name'])->get(),
            'frequencies' => Frequency::cases(),
        ]);
    }
}
