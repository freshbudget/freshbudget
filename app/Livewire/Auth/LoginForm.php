<?php

namespace App\Livewire\Auth;

use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Illuminate\Auth\Events\Authenticated;
use Livewire\Component;

class LoginForm extends Component
{
    use WithRateLimiting;

    public $email = '';

    public $password = '';

    public $remember = true;

    public $usingEmail = false;

    protected $rules = [
        'email' => ['required', 'email'],
        'password' => ['required'],
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

        $status = auth()->attempt($this->only(['email', 'password']), $this->remember);

        if (! $status) {
            $this->addError('status', 'Please try again, the provided credentials do not match our records.');

            return;
        }

        $user = auth()->user();

        event(new Authenticated('web', $user));

        if ($user->twoFactorAuthEnabledAndConfirmed()) {

            session()->put('two_factor', [
                'login.id' => $user->ulid,
                'login.remember' => $this->remember,
            ]);

            // TODO: redirect to two factor challenge
            return redirect()->route('app.index');
        } else {
            return redirect()->intended(route('app.index'));
        }
    }

    public function render()
    {
        return view('auth.login')->extends('layouts.auth')->section('content');
    }
}
