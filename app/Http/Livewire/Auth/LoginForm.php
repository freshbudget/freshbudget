<?php

namespace App\Http\Livewire\Auth;

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
                "Too many attempts, please wait {$exception->secondsUntilAvailable} before next attempt.");
        }

        $this->validate();

        $status = auth()->attempt($this->only(['email', 'password']), $this->remember);

        if (! $status) {
            $this->addError('status', 'The provided credentials do not match our records.');

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
            return redirect()->route('welcome');
        } else {
            return redirect()->intended(route('welcome'));
        }
    }

    public function render()
    {
        return view('auth.login')->extends('layouts.auth')->section('content');
    }
}
