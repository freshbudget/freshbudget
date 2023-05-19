<?php

namespace App\Http\Controllers\App\Incomes;

use App\Domains\Incomes\Models\Income;
use App\Http\Controllers\Controller;

class IncomesController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', [Income::class, currentBudget()]);

        return view('app.incomes.index', [
            'incomes' => currentBudget()->incomes()->orderBy('name')->get(),
        ]);
    }

    public function show(Income $income)
    {
        $this->authorize('show', [$income, currentBudget()]);

        return view('app.incomes.show.index', [
            'income' => $income,
            'incomes' => currentBudget()->incomes()->orderBy('name')->get(),
        ]);
    }

    public function create()
    {
        $this->authorize('create', [Income::class, currentBudget()]);

        return view('app.incomes.create', [
            'incomes' => user()->currentBudget->incomes()->orderBy('name')->get(),
        ]);
    }
}
