<?php

namespace App\Support;

use Illuminate\Contracts\Auth\Authenticatable;

/**
 * Testing API was inspired by Livewire's testing API.
 * 
 * @see https://livewire.laravel.com/docs/testing
 */
class FormActionTester
{
    public function __construct(public FormAction $action)
    {
        //
    }

    public function call(string $method, array $parameters = [])
    {
        $this->action->{$method}(...$parameters);

        return $this;
    }

    /**
     * @see https://github.com/livewire/livewire/blob/482b2fe8356b290ddacf2afdb62ba3054a3bf532/src/Features/SupportTesting/Testable.php#L69
     */
    public function actingAs(Authenticatable $user, string $driver = null)
    {
        if (isset($user->wasRecentlyCreated) && $user->wasRecentlyCreated) {
            $user->wasRecentlyCreated = false;
        }

        auth()->guard($driver)->setUser($user);

        auth()->shouldUse($driver);

        return $this;
    }

    public function assertSet(string $key, mixed $value): bool
    {
        // todo: assert that the value was set
        return true;
    }

    public function assertNotSet(string $key, mixed $value): bool
    {
        return true;
    }
}