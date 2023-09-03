<?php

namespace App\Livewire\Pages\Budgets;

use App\Enums\Currency;
use App\Models\Budget;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CreateBudgetPage extends Component
{
    use AuthorizesRequests;

    #[Rule(['required', 'string', 'min:3', 'max:255'])]
    public $name = '';

    public function attempt()
    {
        $this->authorize('create', Budget::class);

        $this->validate();

        $budget = user()->ownedBudgets()->create([
            'name' => $this->name,
            'currency' => Currency::USD,
        ]);

        user()->switchCurrentBudget($budget);

        return redirect()->route('app.index')->with('success', 'Budget created successfully.');
    }

    public function render()
    {
        return view('livewire.pages.budgets.create')
            ->extends('layouts.app')->section('content');
    }
}
