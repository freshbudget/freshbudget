<?php

namespace App\Livewire\Pages\Auth;

use App\Livewire\Forms\Login as LoginForm;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Illuminate\Auth\Events\Authenticated;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Login extends Component
{
    use WithRateLimiting;

    public LoginForm $form;

    #[Rule(['boolean'])]
    public bool $usingEmail = false;

    protected function checkRateLimit(): bool
    {
        try {
            $this->rateLimit(maxAttempts: 10, decaySeconds: 60);

            return true;
        } catch (TooManyRequestsException $e) {
            $this->addError('status', "Too many attempts, please wait {$e->secondsUntilAvailable} seconds before next attempt.");

            return false;
        }
    }

    public function attempt()
    {
        if (! $this->checkRateLimit()) {
            return;
        }

        if(!$this->form->attempt()) {
            $this->addError('status', 'Please check your credentials and try again.');

            return;
        }

        event(new Authenticated('web', user()));

        if (user()->twoFactorAuthEnabledAndConfirmed()) {

            session()->put('two_factor', [
                'login.id' => user()->ulid,
                'login.remember' => $this->form->remember,
            ]);

            // TODO: redirect to two factor challenge
            return $this->redirect(route('app.index'), true);
        } else {
            return $this->redirect(route('app.index'), true);
        }
    }

    public function render()
    {
        return view('auth.login')->extends('layouts.auth')->section('content');
    }
}
