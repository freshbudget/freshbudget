<?php

namespace App\Livewire\Pages\Auth;

use Illuminate\Auth\Events\Authenticated;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Login extends Component
{
    #[Rule(['required', 'email'])]
    public string $email = '';

    #[Rule(['required'])]
    public string $password = '';

    #[Rule(['boolean'])]
    public bool $remember = true;

    public function mount()
    {
        if(app()->environment('local')) {
            $this->fill([
                'email' => 'admin@email.com',
                'password' => 'password',
            ]);
        }
    }

    public function attempt()
    {
        $this->validate();

        $successful = auth()->attempt(
            credentials: [
                'email' => $this->email,
                'password' => $this->password,
            ],
            remember: $this->remember
        );

        if (! $successful) {
            $this->addError('status', 'Please check your credentials and try again.');

            return;
        }

        event(new Authenticated('web', user()));

        return $this->redirect(route('app.index'), true);
    }

    public function render()
    {
        return view('auth.login')->extends('layouts.auth')->section('content');
    }
}
