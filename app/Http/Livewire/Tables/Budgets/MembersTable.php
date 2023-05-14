<?php

namespace App\Http\Livewire\Tables\Budgets;

use App\Domains\Budgets\Models\BudgetUser;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class MembersTable extends Component implements HasTable
{
    use InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return BudgetUser::where('budget_id', currentBudget()->id);
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('user.name')
                ->label('Name')
                ->sortable()
                ->toggleable()
                ->searchable(),
            TextColumn::make('user.nickname')
                ->label('Nickname')
                ->sortable()
                ->toggleable()
                ->searchable(),
            TextColumn::make('user.email')
                ->label('Email')
                ->sortable()
                ->toggleable()
                ->searchable(),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            // ...
        ];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }

    public function render()
    {
        return view('livewire.tables.budgets.members-table');
    }
}
