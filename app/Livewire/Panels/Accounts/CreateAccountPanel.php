<?php

namespace App\Livewire\Panels\Accounts;

use App\Enums\Currency;
use App\Models\Account;
use App\Models\AssetAccountType;
use App\Models\Institute;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CreateAccountPanel extends Component
{
    use AuthorizesRequests;

    #[Rule(['required', 'string', 'max:255'])]
    public $name = '';

    #[Rule(['required', 'exists:asset_account_types,id'])]
    public $subtype_id = null;

    #[Rule(['nullable'])]
    public $institution_id = null;

    #[Rule(['nullable', 'string', 'max:255'])]
    public $institution_name = null;

    #[Rule(['nullable', 'string', 'url'])]
    public $url = null;

    #[Rule(['nullable', 'exists:users,ulid'])]
    public $user_ulid = null;

    public function updatedSubtypeId($value)
    {
        $cashId = AssetAccountType::where('name', 'Cash')->first()->id;

        if ($value == $cashId) {
            $this->url = null;
        }
    }

    public function updatedInstitutionId($value)
    {
        // if the value is 0, then are creating a new institution
        if ($value == 0) {
            $this->url = null;

            return;
        }

        $institute = Institute::active()->where('id', $value)->first();

        $this->url = $institute?->auth_url;
    }

    public function attempt()
    {
        $this->authorize('create', [Account::class, currentBudget()]);

        $this->validate();

        $owner = currentBudget()->members()->where('ulid', $this->user_ulid)->first();

        if ($this->institution_name) {
            $institute = Institute::create([
                'name' => $this->institution_name,
                'abbr' => $this->institution_name,
                'budget_id' => currentBudget()->id,
                'user_id' => $owner?->id,
            ]);

            $this->institution_id = $institute->id;
        }

        $account = currentBudget()->assetAccounts()->create([
            'user_id' => $owner?->id,
            'name' => $this->name,
            'subtype_id' => $this->subtype_id,
            'currency' => Currency::USD,
            'url' => $this->url,
            'institution_id' => $this->institution_id ?? null,
        ]);

        return redirect()->route('app.accounts.show', $account);
    }

    public function render()
    {
        $institutes = Institute::active()
            ->where('budget_id', currentBudget()->id)
            ->orWhereNull('budget_id')
            ->orderBy('name')
            ->select(['id', 'name'])
            ->get();

        $types = AssetAccountType::query()
            ->where('budget_id', currentBudget()->id)
            ->orWhereNull('budget_id')
            ->orderBy('name')
            ->select(['id', 'name'])
            ->get();

        return view('livewire.panels.accounts.create-account-panel', [
            'types' => $types,
            'institutes' => $institutes,
            'users' => currentBudget()->members()->orderBy('name')->select(['users.ulid', 'name'])->get(),
        ]);
    }
}
