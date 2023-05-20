<?php

namespace App\Http\Controllers\App\Incomes;

use App\Domains\Incomes\Models\Income;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;

class IncomesController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', [Income::class, currentBudget()]);

        return view('app.incomes.index', [
            'incomes' => $this->incomes(),
        ]);
    }

    public function show(Income $income)
    {
        $this->authorize('show', [$income, currentBudget()]);

        return view('app.incomes.show.index', [
            'income' => $income,
            'incomes' => $this->incomes(),
        ]);
    }

    public function create()
    {
        $this->authorize('create', [Income::class, currentBudget()]);

        return view('app.incomes.create', [
            'incomes' => $this->incomes(),
        ]);
    }

    public function destroy(Income $income)
    {
        $this->authorize('delete', [$income, currentBudget()]);

        $income->delete();

        return redirect()->route('app.incomes.index');
    }

    private function incomes(): Collection
    {
        return currentBudget()->incomes()->where('active', true)->orderBy('name')->get();
    }
}
