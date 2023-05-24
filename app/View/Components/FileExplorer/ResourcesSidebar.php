<?php

namespace App\View\Components\FileExplorer;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class ResourcesSidebar extends Component
{
    public Collection $resources;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // get all the current budgets incomes
        $incomes = currentBudget()->incomes()->select(['ulid', 'name'])->get();

        $accounts = collect();
        
        $this->resources = $accounts->merge($incomes);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.file-explorer.resources-sidebar');
    }
}
