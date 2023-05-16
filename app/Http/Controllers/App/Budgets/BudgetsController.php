<?php

namespace App\Http\Controllers\App\Budgets;

use App\Domains\Budgets\Actions\CreateBudgetAction;
use App\Domains\Budgets\Models\Budget;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BudgetsController extends Controller
{
    public function create()
    {
        $this->authorize('create', Budget::class);

        return view('app.budgets.create', [
            'budgets' => user()->budgets()->orderBy('name')->get(),
        ]);
    }

    public function destroy(Budget $budget)
    {
        $this->authorize('delete', $budget);

        $budget->update([
            'deleted_by' => user()->id,
        ]);

        // need to update the current budget if it's the one being deleted
        if (user()->current_budget_id === $budget->id) {
            user()->update([
                'current_budget_id' => null,
            ]);
        }

        $budget->delete();

        return redirect()->route('app.budgets.index');
    }

    public function edit(Budget $budget)
    {
        $this->authorize('edit', $budget);

        return view('app.budgets.show.settings', [
            'budget' => $budget,
            'budgets' => user()->budgets()->orderBy('name')->get(),
        ]);
    }

    public function index()
    {
        $this->authorize('viewAny', Budget::class);

        return view('app.budgets.index', [
            'budgets' => user()->budgets()->orderBy('name')->get(),
        ]);
    }

    public function show(Budget $budget)
    {
        $this->authorize('view', $budget);

        return view('app.budgets.show.index', [
            'budget' => $budget,
            'budgets' => user()->budgets()->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Budget::class);

        $action = new CreateBudgetAction();

        $validated = $this->validate($request, $action::rules());

        $budget = $action->execute($validated, user());

        user()->switchCurrentBudget($budget);

        return redirect()->route('app.budgets.show', $budget);
    }
}
