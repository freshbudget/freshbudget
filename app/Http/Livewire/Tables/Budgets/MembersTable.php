<?php

namespace App\Http\Livewire\Tables\Budgets;

use App\Domains\Budgets\Models\Budget;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class MembersTable extends Component implements HasTable
{
    use InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return Budget::query();
    }

    public function render()
    {
        return view('livewire.tables.budgets.members-table');
    }
}
