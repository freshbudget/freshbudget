<?php

namespace App\Support\Concerns;

use App\Support\FormAction;
use Illuminate\Auth\Access\AuthorizationException;

trait AuthorizationInteractions
{
    protected bool $shouldAuthorize = true;

    /**
     * The array of callbacks to run before authorization
     *
     * @var array<callable>
     */
    protected array $beforeAuthorizationCallbacks = [];

    /**
     * The array of callbacks to run after authorization
     *
     * @var array<callable>
     */
    protected array $afterAuthorizationCallbacks = [];

    /**
     * The array of callbacks to run after an authorization failure
     *
     * @var array<callable>
     */
    protected array $onFailedAuthorizationCallbacks = [];

    public function beforeAuthorization(callable $callback): FormAction
    {
        $this->beforeAuthorizationCallbacks[] = $callback;

        return $this;
    }

    public function authorize(): bool
    {
        return true;
    }

    public function afterAuthorization(callable $callback): FormAction
    {
        $this->afterAuthorizationCallbacks[] = $callback;

        return $this;
    }

    public function onFailedAuthorization(callable $callback): FormAction
    {
        $this->onFailedAuthorizationCallbacks[] = $callback;

        return $this;
    }

    protected function failedAuthorization()
    {
        if (empty($this->onFailedAuthorizationCallbacks)) {
            throw new AuthorizationException;
        }

        foreach ($this->onFailedAuthorizationCallbacks as $callback) {
            $this->app->call($callback);
        }
    }

    public function withAuthorization(): FormAction
    {
        $this->shouldAuthorize = true;

        return $this;
    }

    public function withoutAuthorization(): FormAction
    {
        $this->shouldAuthorize = false;

        return $this;
    }

    protected function checkAuthorization(): FormAction
    {
        if ($this->shouldAuthorize) {

            foreach ($this->beforeAuthorizationCallbacks as $callback) {
                $this->app->call($callback);
            }

            // check if the action is authorized to run
            if (! $this->authorize()) {
                // most likely throw an exception
                $this->failedAuthorization();
            }

            foreach ($this->afterAuthorizationCallbacks as $callback) {
                $this->app->call($callback);
            }

        }

        return $this;
    }
}
