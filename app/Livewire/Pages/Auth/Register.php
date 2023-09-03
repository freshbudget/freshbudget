<?php

namespace App\Livewire\Pages\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Register extends Component
{
    #[Rule(['required', 'string', 'min:2', 'max:255'])]
    public $name = '';

    #[Rule(['required', 'email', 'unique:users,email'])]
    public $email = '';

    #[Rule(['required', 'string', 'confirmed'])]
    public $password = '';

    #[Rule(['required', 'string'])]
    public $password_confirmation = '';

    public bool $usingEmail = false;

    public function attempt()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ]);

        event(new Registered($user));

        auth()->login($user, remember: true);

        return redirect()->route('app.index');
    }

    public function render()
    {
        return view('auth.register')->extends('layouts.auth')->section('content');
    }
}
