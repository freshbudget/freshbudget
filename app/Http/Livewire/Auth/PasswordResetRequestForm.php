<?php

namespace App\Http\Livewire\Auth;

use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Illuminate\Support\Facades\Password;
use Livewire\Component;

class PasswordResetRequestForm extends Component
{
    use WithRateLimiting;

    public string $email = '';

    protected $rules = [
        'email' => ['required', 'email'],
    ];

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

        Password::sendResetLink(
            ['email' => $this->email]
        );

        session()->flash('status', 'If an account with that email exists, we have sent a password reset link.');
    }

    public function render()
    {
        return view('auth.password-reset-request')
            ->extends('layouts.auth')
            ->section('content');
    }
}
