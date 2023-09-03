<?php

namespace App\Livewire\Auth;

use App\Models\User;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password as PasswordBroker;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class PasswordResetForm extends Component
{
    use WithRateLimiting;

    public string $token = '';

    public string $email = '';

    public string $password = '';

    public function mount()
    {
        $this->token = request()->token;
        $this->email = request()->email;
    }

    protected function rules(): array
    {
        return [
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', Password::defaults()],
        ];
    }

    public function attempt()
    {
        try {
            $this->rateLimit(maxAttempts: 10, decaySeconds: 60);
        } catch (TooManyRequestsException $exception) {
            $this->addError('status', "Too many attempts, please wait {$exception->secondsUntilAvailable} seconds before next attempt.");

            return;
        }

        $this->validate();

        $status = PasswordBroker::reset([
            'email' => $this->email,
            'password' => $this->password,
            'token' => $this->token,
        ],
            function (User $user) {
                $user->forceFill([
                    'password' => $this->password,
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === PasswordBroker::INVALID_TOKEN) {
            $this->addError('status', 'This password reset token is invalid.');

            return;
        }

        if ($status === PasswordBroker::INVALID_USER) {
            $this->addError('status', 'We can\'t find a user with that email address.');

            return;
        }

        if ($status === PasswordBroker::RESET_THROTTLED) {
            $this->addError('status', 'Too many password reset attempts. Please try again in :seconds seconds.');

            return;
        }

        auth()->login(User::where('email', $this->email)->first());

        return redirect()->route('app.index');
    }

    public function render()
    {
        return view('auth.password-reset', [
            'email' => request()->email,
            'token' => request()->token,
        ])->extends('layouts.auth')->section('content');
    }
}
