<?php

namespace App\Livewire\Panels\Account;

use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use Livewire\Component;

class UpdatePasswordPanel extends Component
{
    #[Rule(['required'])]
    public string $current_password = '';

    #[Rule(['required', 'confirmed'])]
    public string $password = '';

    #[Rule(['required'])]
    public string $password_confirmation = '';

    public function attempt()
    {
        $this->validate();

        if (! Hash::check($this->current_password, user()->password)) {
            $this->addError('current_password', 'The provided password does not match your current password.');

            return;
        }

        user()->update([
            'password' => bcrypt($this->password),
        ]);

        $this->reset();

        $this->dispatch('user-password-updated');
    }

    public function render()
    {
        return view('livewire.panels.account.update-password-panel');
    }
}
