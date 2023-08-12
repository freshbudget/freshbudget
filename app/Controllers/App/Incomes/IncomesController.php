<?php

namespace App\Controllers\App\Incomes;

use App\Domains\Accounts\Models\Account;
use App\Domains\Incomes\Models\Income;
use App\Domains\Incomes\Models\IncomeType;
use App\Domains\Shared\Enums\Frequency;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class IncomesController
{
    use AuthorizesRequests, ValidatesRequests;

    public function destroy(Income $income)
    {
        $this->authorize('delete', [$income, currentBudget()]);

        $income->delete();

        return redirect()->route('app.incomes.index');
    }

    public function edit(Income $income)
    {
        $this->authorize('update', [$income, currentBudget()]);

        return view('app.incomes.show.edit', [
            'income' => $income,
            'types' => IncomeType::orderBy('name')->get(['id', 'name']),
            'frequencies' => Frequency::cases(),
        ]);
    }

    public function overview()
    {
        $this->authorize('viewAny', [Account::class, currentBudget()]);

        $incomes = currentBudget()->activeIncomes()->orderBy('name')->get();

        return view('app.incomes.index', [
            'incomes' => $incomes,
        ]);
    }

    public function index()
    {
        $this->authorize('viewAny', [Account::class, currentBudget()]);

        $incomes = currentBudget()->incomes()->orderBy('name')->get();

        return view('app.incomes.list', [
            'incomes' => $incomes,
        ]);
    }

    public function update(Income $income, Request $request)
    {
        $this->authorize('update', [$income, currentBudget()]);

        $validated = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'type_id' => ['required', 'exists:income_types,id'],
            'frequency' => ['required', new Enum(Frequency::class)],
            'url' => ['nullable', 'url'],
        ]);

        $income->update($validated);

        return redirect()->back(fallback: route('app.incomes.show', $income));
    }

    public function show(Account $account)
    {
        $this->authorize('view', [$account, currentBudget()]);

        return view('app.incomes.show.index', [
            'income' => $account,
        ]);
    }
}
