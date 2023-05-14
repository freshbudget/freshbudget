<?php

namespace App\Http\Controllers\App\Incomes;

use App\Domains\Incomes\Models\Income;
use App\Domains\Incomes\Models\IncomeFrequency;
use App\Domains\Incomes\Models\IncomeType;
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

        return view('app.incomes.show', [
            'income' => $income,
            'incomes' => currentBudget()->incomes()->orderBy('name')->get(),
        ]);
    }

    public function create()
    {
        $this->authorize('create', [Income::class, currentBudget()]);

        return view('app.incomes.create', [
            'incomes' => user()->currentBudget->incomes()->orderBy('name')->get(),
            'users' => user()->currentBudget->users()->orderBy('name')->select(['users.ulid', 'name'])->get(),
            'types' => IncomeType::orderBy('name')->select(['id', 'name'])->get(),
            'frequencies' => IncomeFrequency::orderBy('name')->select(['id', 'name'])->get(),
        ]);
    }
}
