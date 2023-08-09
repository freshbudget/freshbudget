<?php

namespace App\Controllers\App\Budgets;

use App\Domains\Budgets\Actions\CreateBudgetAction;
use App\Domains\Budgets\Models\Budget;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class BudgetsController
{
    use AuthorizesRequests, ValidatesRequests;

    public function create()
    {
        $this->authorize('create', Budget::class);

        return view('app.budgets.create');
    }

    public function destroy(Budget $budget)
    {
        $this->authorize('delete', $budget);

        if ($budget->personal) {
            return back(fallback: route('app.budgets.edit', $budget))->withErrors([
                'budget' => 'You cannot delete your personal budget, you must either transfer ownership or delete your account.',
            ]);
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

        return view('app.budgets.show.settings.general', [
            'budget' => $budget,
        ]);
    }

    public function update(Budget $budget)
    {
        $this->authorize('edit', $budget);

        $validated = $this->validate(request(), [
            'name' => ['required', 'string', 'max:255'],
        ]);

        $budget->update($validated);

        return redirect()->back(fallback: route('app.budgets.edit', $budget));
    }

    public function index()
    {
        $this->authorize('viewAny', Budget::class);

        $budgets = user()->joinedBudgets()->withCount('members')->orderBy('name')->get();

        return view('app.budgets.index', [
            'budgets' => $budgets,
        ]);
    }

    public function show(Budget $budget)
    {
        $this->authorize('view', $budget);

        return view('app.budgets.show.index', [
            'budget' => $budget,
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Budget::class);

        $action = new CreateBudgetAction();

        $validated = $this->validate($request, $action::rules());

        $budget = $action->execute(user(), $validated);

        user()->switchCurrentBudget($budget);

        return redirect()->route('app.index');
    }
}
