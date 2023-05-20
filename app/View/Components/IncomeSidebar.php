<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;

class IncomeSidebar extends Component
{
    public Collection $incomes;
    
    public function __construct()
    {
        $this->incomes = currentBudget()->incomes()->where('active', true)->orderBy('name')->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.income-sidebar');
    }
}
