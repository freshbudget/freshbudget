<?php

namespace App\Http\Controllers\App\Incomes;

use App\Domains\Incomes\Models\Income;
use App\Http\Controllers\Controller;

class IncomesController extends Controller
{
    public function edit(Income $income)
    {
        $this->authorize('update', [$income, currentBudget()]);

        return view('app.incomes.show.edit', [
            'income' => $income,
        ]);
    }

    public function index()
    {
        $this->authorize('viewAny', [Income::class, currentBudget()]);

        return view('app.incomes.index', [
            'incomes' => currentBudget()->incomes()->where('active', true)->orderBy('name')->get(),
        ]);
    }

    public function show(Income $income)
    {
        $this->authorize('view', [$income, currentBudget()]);

        return view('app.incomes.show.index', [
            'income' => $income,
        ]);
    }

    public function create()
    {
        $this->authorize('create', [Income::class, currentBudget()]);

        return view('app.incomes.create');
    }

    public function destroy(Income $income)
    {
        $this->authorize('delete', [$income, currentBudget()]);

        $income->delete();

        return redirect()->route('app.incomes.index');
    }
}
