<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class IncomeSidebar extends Component
{
    public Collection $incomes;

    public function __construct()
    {
        $this->incomes = currentBudget()->activeIncomes()->orderBy('name')->get();
    }

    public function render(): View
    {
        return view('components.income-sidebar');
    }
}
