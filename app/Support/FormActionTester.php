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
     * @param Authenticatable $user
     */
    public function actingAs($user, string $driver = null)
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
        return true;
    }

    public function assertNotSet(string $key, mixed $value): bool
    {
        return true;
    }
}
