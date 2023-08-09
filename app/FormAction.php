<?php

namespace App;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Rule;

/**
 * Form Action Lifecycle
 *
 * 1. Instantiate the action with the request
 * 2. Set the request, this will merge the request data with any additional data
 * 3.
 */
abstract class FormAction
{
    public function __construct(public ?Container $app = null, public ?Request $request = null)
    {
        if (! $app) {
            $this->app = app();
        }

        if (! $request) {
            $this->request = request();
        }

        $this->setRequest($this->request);
    }

    public static function make(Container $app = null, Request $request = null): self
    {
        return new static($app, $request);
    }

    /*
    |--------------------------------------------------------------------------
    | Request Features
    |--------------------------------------------------------------------------
    */
    public function setRequest(Request $request): self
    {
        $this->request = $request;

        return $this;
    }

    public function set(string|array $key, mixed $value = null, bool $replace = false): self
    {
        if (is_array($key)) {
            if ($replace) {
                $this->request->replace($key);
            } else {
                $this->request->merge($key);
            }
        } else {

            if (is_callable($value)) {
                $value = $this->app->call($value);
            }

            // TODO: Check if the value is an Enum, if so, get the value

            if ($replace) {
                $this->request->replace([$key => $value]);
            } else {
                if (! $this->request->has($key)) {
                    $this->request->merge([$key => $value]);
                }
            }
        }

        return $this;
    }

    public function replace(string|array $key, $value): self
    {
        $this->set($key, $value, replace: true);

        return $this;
    }

    public function has(string|array $key): bool
    {
        return $this->request->has($key);
    }

    public function hasAny(string|array $keys): bool
    {
        return $this->request->hasAny($keys);
    }

    public function hasAll(array $keys): bool
    {
        foreach ($keys as $key) {
            if (! $this->has($key)) {
                return false;
            }
        }

        return true;
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->request->get($key, $default);
    }

    /*
    |--------------------------------------------------------------------------
    | Authorization Features
    |--------------------------------------------------------------------------
    */
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

    public function beforeAuthorization(callable $callback): self
    {
        $this->beforeAuthorizationCallbacks[] = $callback;

        return $this;
    }

    public function authorize(): bool
    {
        return true;
    }

    public function afterAuthorization(callable $callback): self
    {
        $this->afterAuthorizationCallbacks[] = $callback;

        return $this;
    }

    public function onFailedAuthorization(callable $callback): self
    {
        $this->onFailedAuthorizationCallbacks[] = $callback;

        return $this;
    }

    protected function failedAuthorization()
    {
        $this->onFailedAuthorization(function () {
            throw new AuthorizationException;
        });

        foreach ($this->onFailedAuthorizationCallbacks as $callback) {
            $this->app->call($callback);
        }
    }

    public function withAuthorization(): self
    {
        $this->shouldAuthorize = true;

        return $this;
    }

    public function withoutAuthorization(): self
    {
        $this->shouldAuthorize = false;

        return $this;
    }

    /*
    |--------------------------------------------------------------------------
    | Validation Features
    |--------------------------------------------------------------------------
    */
    protected Validator $validator;

    protected bool $shouldValidate = true;

    /**
     * The array of callbacks to run before validation
     *
     * @var array<callable>
     */
    protected array $beforeValidationCallbacks = [];

    /**
     * The array of callbacks to run after validation
     *
     * @var array<callable>
     */
    protected array $afterValidationCallbacks = [];

    /**
     * The array of callbacks to run after a validation failure
     *
     * @var array<callable>
     */
    protected array $onFailedValidationCallbacks = [];

    public function beforeValidation(callable $callback): self
    {
        $this->beforeValidationCallbacks[] = $callback;

        return $this;
    }

    public function validate()
    {
        // TODO:
    }

    public function afterValidation(callable $callback): self
    {
        $this->afterValidationCallbacks[] = $callback;

        return $this;
    }

    public function onValidationFailure(callable $callback): self
    {
        $this->onFailedValidationCallbacks[] = $callback;

        return $this;
    }

    public function failedValidation($validator)
    {
        $this->onFailedValidation(function () use ($validator) {
            throw (new ValidationException($validator));
        });

        foreach ($this->onFailedValidationCallbacks as $callback) {
            $this->app->call($callback);
        }
    }

    public function withValidation(): self
    {
        $this->shouldValidate = true;

        return $this;
    }

    public function withoutValidation(): self
    {
        $this->shouldValidate = false;

        return $this;
    }

    protected function getValidatorInstance(): Validator
    {
        if ($this->validator) {
            return $this->validator;
        }

        if (method_exists($this, 'validator')) {
            $validator = $this->app->call([$this, 'validator']);

            if (! $validator instanceof Validator) {
                throw new \Exception('The validator method must return an instance of '.Validator::class);
            }

            $this->validator = $validator;
        } else {
            /** @var ValidationFactory $factory */
            $factory = $this->container->make(ValidationFactory::class);

            $this->validator = $factory->make(
                $this->request->all(),
                $this->getAllValidationRules(), 
                $this->getAllValidationMessages(), 
                $this->getAllValidationAttributes()
            );
        }

        return $this->validator;
    }

    /*
    |--------------------------------------------------------------------------
    | Validation Rule Features
    |--------------------------------------------------------------------------
    */
    public function rules(): array
    {
        return [];
    }

    public function getAllValidationRules(): array
    {
        return array_merge(
            $this->getRulesFromTheRulesProperty(),
            $this->getRulesFromTheRulesMethod(),
            $this->getRulesFromRuleAttributesOnPublicProperties(),
        );
    }

    private function getRulesFromTheRulesProperty(): array
    {
        if (isset($this->rules) && is_array($this->rules)) {
            return $this->rules;
        }

        return [];
    }

    private function getRulesFromTheRulesMethod(): array
    {
        $rules = $this->app->call([$this, 'rules']);

        if (! is_array($rules)) {
            throw new \Exception('The rules method must return an array of rules');
        }

        return $rules;
    }

    /*
    |--------------------------------------------------------------------------
    | Validation Message Features
    |--------------------------------------------------------------------------
    */
    public function messages(): array
    {
        return [];
    }

    public function getAllValidationMessages(): array
    {
        return array_merge(
            $this->getMessagesFromTheMessagesProperty(),
            $this->getMessagesFromTheMessagesMethod(),
        );
    }

    private function getMessagesFromTheMessagesProperty(): array
    {
        if (isset($this->messages) && is_array($this->messages)) {
            return $this->messages;
        }

        return [];
    }

    private function getMessagesFromTheMessagesMethod(): array
    {
        $messages = $this->app->call([$this, 'messages']);

        if (! is_array($messages)) {
            throw new \Exception('The messages method must return an array of messages');
        }

        return $messages;
    }

    private function getRulesFromRuleAttributesOnPublicProperties(): array
    {
        $object = new \ReflectionObject($this);

        $rules = [];

        foreach ($object->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {

            // check if the property has a Rule attribute
            $attributes = $property->getAttributes(Rule::class);

            // if the property has a Rule attribute
            if (count($attributes) > 0) {
                //
            }
        }

        return [];
    }

    /*
    |--------------------------------------------------------------------------
    | Validation Attribute Features
    |--------------------------------------------------------------------------
    */
    public function attributes(): array
    {
        return [];
    }

    public function getAllValidationAttributes(): array
    {
        return array_merge(
            $this->getAttributesFromTheAttributesProperty(),
            $this->getAttributesFromTheAttributesMethod(),
        );
    }

    private function getAttributesFromTheAttributesProperty(): array
    {
        if (isset($this->attributes) && is_array($this->attributes)) {
            return $this->attributes;
        }

        return [];
    }

    private function getAttributesFromTheAttributesMethod(): array
    {
        $attributes = $this->app->call([$this, 'attributes']);

        if (! is_array($attributes)) {
            throw new \Exception('The attributes method must return an array of attributes');
        }

        return $attributes;
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

    public function attempt(int $maxAttempts = 1): self
    {
        if ($maxAttempts < 1) {
            throw new \InvalidArgumentException('The maximum number of attempts must be at least 1');
        }

        $this->maxAttempts = $maxAttempts;

        while ($this->attemptCount <= $maxAttempts) {

            /**
             * 1. Run the Authorization Workflow
             */
            if ($this->shouldAuthorize) {

                foreach ($this->beforeAuthorizationCallbacks as $callback) {
                    $this->app->call($callback);
                }

                // check if the action is authorized to run
                if (! $this->authorize()) {
                    // most likely throw an exception
                    $this->failedAuthorization();

                    // but if not ... ?

                    continue;
                }

                foreach ($this->afterAuthorizationCallbacks as $callback) {
                    $this->app->call($callback);
                }

            }

            /**
             * 2. Run the Validation Workflow
             */
            if ($this->shouldValidate) {

                foreach ($this->beforeValidationCallbacks as $callback) {
                    $this->app->call($callback);
                }

                // validate the request
                // TODO: Call the proper method

                // run the after validation callbacks
                foreach ($this->afterValidationCallbacks as $callback) {
                    $this->app->call($callback);
                }

            }

            /**
             * 3. Run the Action Workflow
             */
            $this->attemptCount++;
        }

        return $this;
    }

    /**
     * The array of callbacks to run after a successful action
     *
     * @var array<callable>
     */
    protected array $afterSuccessCallbacks = [];

    public function afterSuccess(callable $callback): self
    {
        $this->afterSuccessCallbacks = $callback;

        return $this;
    }

    public function mapRequestInputsToPublicAttributes()
    {
        // if the class has any public properties with a Rule attribute, see if there is a data key for it
        $reflection = new \ReflectionClass($this);

        foreach ($reflection->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {

            // check if the property has a Rule attribute
            $attributes = $property->getAttributes(Rule::class);

            // if the property has a Rule attribute
            if (count($attributes) > 0) {
                //
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Magic Method Features
    |--------------------------------------------------------------------------
    */
    public function __call($method, $parameters)
    {
        if (! method_exists($this->request, $method)) {
            throw new \BadMethodCallException("Method {$method} does not exist on the action or the request");
        }

        return $this->request->{$method}(...$parameters);
    }

    public function __get($key)
    {
        if (! $this->request->has($key)) {
            // throw a property not found exception
            throw new \BadMethodCallException("Property {$key} does not exist on the action or the request");
        }

        return $this->request->get($key);
    }
}

/**
 * Ideas
 * - Add an inteface to the class if you want it to auto-validate on resolve like form requests
 * - If the service provider we can check if the class extends the interface
 * - implement the addError api from Livewire
 * - implement the stop on first error from normal requests
 * - implement the messages and attributes
 */
