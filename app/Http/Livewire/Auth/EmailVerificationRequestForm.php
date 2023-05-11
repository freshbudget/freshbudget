<?php

namespace App\Http\Livewire\Auth;

use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Exception;
use Livewire\Component;

class EmailVerificationRequestForm extends Component
{
    use WithRateLimiting;

    public function attempt()
    {
        try {
            $this->rateLimit(maxAttempts: 2, decaySeconds: 60);

            auth()->user()->sendEmailVerificationNotification();

            session()->flash('status', 'Verification link sent! Check your email inbox.');
        } catch (TooManyRequestsException $exception) {
            $this->addError('status', "Too many attempts. Please try again in {$exception->secondsUntilAvailable}.");
        } catch (Exception $exception) {
            $this->addError('status', 'An error occurred. Please try again in a few minutes.');
        }
    }

    public function render()
    {
        return view('auth.email-verification')->extends('layouts.auth')->section('content');
    }
}
