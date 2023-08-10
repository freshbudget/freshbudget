<?php

namespace App\Support;

use App\Support\Concerns\AuthorizationInteractions;
use App\Support\Concerns\RequestInteractions;
use App\Support\Concerns\ValidationInteractions;
use Error;
use Illuminate\Contracts\Container\Container;
use Illuminate\Http\Request;

abstract class FormAction
{
    use RequestInteractions,
        ValidationInteractions,
        AuthorizationInteractions;

    /*
    |--------------------------------------------------------------------------
    | Constructor Features
    |--------------------------------------------------------------------------
    */
    public function __construct(protected ?Container $app = null, protected ?Request $request = null)
    {
        if (! $app) {
            $this->app = app();
        }

        if (! $request) {
            $this->request = request();
        }

        $this->setRequest($this->request);
    }

    public static function make(Container $app = null, Request $request = null): static
    {
        return new static($app, $request);
    }

    public static function test(string $action): FormActionTester
    {
        return new FormActionTester(app($action));
    }

    /*
    |--------------------------------------------------------------------------
    | Public Property Features
    |--------------------------------------------------------------------------
    */
    public function mapRequestInputsToPublicAttributes()
    {
        $except = [
            'attributes',
            'messages',
            'rules',
        ];

        if (property_exists($this, 'dontMap')) {
            $except = array_merge($except, $this->dontMap);
        }

        $reflection = new \ReflectionClass($this);

        $properties = array_filter(
            $reflection->getProperties(\ReflectionProperty::IS_PUBLIC), function ($property) use ($except) {
                return ! in_array($property->getName(), $except);
            });

        foreach ($properties as $property) {

            // if ($property->getType() instanceof \ReflectionUnionType) {
            //     dd($property->getType()->getTypes());
            // }

            // check if the property name is in the validated request data
            if (array_key_exists($property->getName(), $this->validated())) {
                $requestValue = $this->request->input($property->getName());
                $requestValueType = gettype($requestValue);

                $propertyName = $property->getName();
                $propertyTypeName = $property->getType()->getName();

                if ($requestValueType === $propertyTypeName) {
                    $this->{$property->getName()} = $requestValue;
                } else {
                    // // TODO: cast the request value to the property type
                    // throw new \Exception("The request value '{$propertyName}' type '{$requestValueType}' for does not match the property type '{$propertyTypeName}'");
                    // //$this->{$property->getName()} = $this->cast($requestValue, $propertyTypeName);
                }
            }

        }
    }

    /*
    |--------------------------------------------------------------------------
    | Attempt Features
    |--------------------------------------------------------------------------
    */
    /**
     * The current attempt count, if 0, the action has not been attempted
     */
    protected int $attemptCount = 0;

    /**
     * The maximum number of attempts to run the action
     */
    protected int $maxAttempts = 1;

    public function attempt(int $maxAttempts = 1): static
    {
        if ($maxAttempts < 1) {
            throw new \InvalidArgumentException('The maximum number of attempts must be at least 1');
        }

        $this->maxAttempts = $maxAttempts;

        while ($this->attemptCount <= $maxAttempts) {

            $this->checkAuthorization();

            $this->validate();

            if (method_exists($this, 'handle')) {
                $result = $this->handle();
            } elseif (method_exists($this, 'execute')) {
                $result = $this->execute();
            } elseif (method_exists($this, '__invoke')) {
                $result = $this->__invoke();
            } else {
                throw new \Exception('The action does not have a handle, execute, or __invoke method');
            }

            $this->attemptCount++;
        }

        return $this;
    }

    /*
    |--------------------------------------------------------------------------
    | Magic Method Features
    |--------------------------------------------------------------------------
    */
    protected $allowGetProxiesToRequest = true;

    public function __call($method, $parameters)
    {
        if (! method_exists($this->request, $method)) {
            throw new \BadMethodCallException("Method {$method} does not exist on the action or the request");
        }

        return $this->request->{$method}(...$parameters);
    }

    public function __get($key)
    {
        if (! $this->allowGetProxiesToRequest) {

            if (! property_exists($this, $key)) {
                return null;
            }

            if (property_exists($this, $key)) {
                throw new Error("Cannot access protected property '{$key}' on the action");
            }
        }

        if (! $this->request->has($key)) {
            // throw a property not found exception
            throw new \BadMethodCallException("Property {$key} does not exist on the action or the request");
        }

        return $this->request->get($key);
    }

    public function dontProxyToRequest()
    {
        $this->allowGetProxiesToRequest = false;

        return $this;
    }

    public function allowProxyToRequest()
    {
        $this->allowGetProxiesToRequest = true;

        return $this;
    }
}

/**
 * Ideas
 * - Add an inteface to the class if you want it to auto-validate on resolve like form requests
 * - If the service provider we can check if the class extends the interface
 * - implement the addError api from Livewire
 * - implement the stop on first error from normal requests
 */
