<?php

namespace App\Http\Livewire\Forms\Incomes;

use App\Domains\Users\Models\User;
use Livewire\Component;

class CreateIncomeForm extends Component
{
    public $name = '';

    public $type_id = null;

    public $frequency_id = null;

    public $amount = null;

    public $user_ulid = null;

    public $description = '';

    public function rules(): array
    {
        return [
            //
        ];
    }

    public function attempt()
    {
        $user_id = User::where('ulid', $this->user_id)->first()->id;

        user()->currentBudget->incomes()->create([
            'name' => $this->name,
            'type_id' => $this->type_id,
            'frequency_id' => $this->frequency_id,
            'amount' => $this->amount,
            'user_id' => $this->user_id,
            'description' => $this->description,
        ]);
    }

    public function render()
    {
        return view('livewire.forms.incomes.create-income-form');
    }
}
