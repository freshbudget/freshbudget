<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Form;

class Login extends Form
{
    #[Rule(['required', 'email'])]
    public string $email = '';

    #[Rule(['required'])]
    public string $password = '';

    #[Rule(['boolean'])]
    public bool $remember = true;

    public function attempt(): bool
    {
        $this->validate();

        return auth()->attempt(
            credentials: [
                'email' => $this->email,
                'password' => $this->password,
            ],
            remember: $this->remember
        );
    }
}
