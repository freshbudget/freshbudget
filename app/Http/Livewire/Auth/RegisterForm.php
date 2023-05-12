<?php

namespace App\Http\Livewire\Auth;

use App\Domains\Users\Models\User;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class RegisterForm extends Component
{
    use WithRateLimiting;

    public $name = '';

    public $email = '';

    public $password = '';

    public $password_confirmation = '';

    public $usingEmail = false;

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }

    public function attempt()
    {
        try {
            $this->rateLimit(maxAttempts: 10, decaySeconds: 60);
        } catch (TooManyRequestsException $exception) {
            $this->addError(
                'status',
                "Too many attempts, please wait {$exception->secondsUntilAvailable} seconds before next attempt.");

            return;
        }

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
