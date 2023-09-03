<?php

namespace App\Livewire\Panels\Accounts;

use App\Enums\Currency;
use App\Models\Account;
use App\Models\AssetAccountType;
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

    #[Rule(['nullable', 'exists:users,ulid'])]
    public $user_ulid = null;

    public function attempt()
    {
        $this->authorize('create', [Account::class, currentBudget()]);

        $this->validate();

        $owner = currentBudget()->members()->where('ulid', $this->user_ulid)->first();

        $account = currentBudget()->assetAccounts()->create([
            'user_id' => $owner?->id,
            'name' => $this->name,
            'subtype_id' => $this->subtype_id,
            'currency' => Currency::USD,
        ]);

        return redirect()->route('app.accounts.show', $account);
    }

    public function render()
    {
        return view('livewire.panels.accounts.create-account-panel', [
            'users' => currentBudget()->members()->orderBy('name')->select(['users.ulid', 'name'])->get(),
            'types' => AssetAccountType::orderBy('name')->select(['id', 'name'])->get(),
        ]);
    }
}
