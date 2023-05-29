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
            'budgets' => user()->joinedBudgets()->orderBy('name')->get(),
        ]);
    }

    public function destroy(Budget $budget)
    {
        $this->authorize('delete', $budget);

        if ($budget->personal) {
            // throw an error
            dd('You cannot delete a personal budget');
        }

        if ($budget->hasCurrentMembers(user())) {
            // throw an error, or ask if they want to transfer ownership
            dd('You cannot delete a budget that still has users');
        }

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
            'budgets' => user()->joinedBudgets()->orderBy('name')->get(),
        ]);
    }

    public function index()
    {
        $this->authorize('viewAny', Budget::class);

        $budgets = user()->joinedBudgets()->orderBy('name')->get();
        $budgets = $budgets->merge(user()->ownedBudgets()->orderBy('name')->get());

        return view('app.budgets.index', [
            'budgets' => $budgets,
        ]);
    }

    public function show(Budget $budget)
    {
        $this->authorize('view', $budget);

        return view('app.budgets.show.index', [
            'budget' => $budget,
            'budgets' => user()->joinedBudgets()->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Budget::class);

        $action = new CreateBudgetAction();

        $validated = $this->validate($request, $action::rules());

        $budget = $action->execute(user(), $validated);

        user()->switchCurrentBudget($budget);

        return redirect()->route('app.budgets.show', $budget);
    }
}
