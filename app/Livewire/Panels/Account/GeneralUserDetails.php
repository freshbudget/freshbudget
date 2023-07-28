<?php

namespace App\Livewire\Panels\Account;

use Livewire\Attributes\Rule;
use Livewire\Component;

class GeneralUserDetails extends Component
{
    #[Rule(['required', 'min:3', 'max:255'])]
    public string $name = '';

    #[Rule(['nullable', 'min:3', 'max:255'])]
    public string $nickname = '';

    public function mount()
    {
        $this->name = user()->name;

        $this->nickname = user()->nickname ?? '';
    }

    public function attempt()
    {
        $this->validate();

        if ($this->isDirty()) {
            user()->update([
                'name' => $this->name,
                'nickname' => $this->nickname ? $this->nickname : null,
            ]);

            $this->dispatch('user-display-name-updated', name: user()->displayName);
        }

    }

    public function render()
    {
        return view('livewire.panels.account.general-user-details');
    }

    protected function isDirty()
    {
        return $this->name != user()->name || $this->nickname != user()->nickname;
    }
}
