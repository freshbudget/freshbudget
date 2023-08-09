<?php

namespace App\Support\Concerns;

use App\Support\FormAction;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;

trait ValidationInteractions
{
    protected Validator $validator;

    protected bool $shouldValidate = true;

    protected bool $didValidationPass = false;

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

    public function beforeValidation(callable $callback): FormAction
    {
        $this->beforeValidationCallbacks[] = $callback;

        return $this;
    }

    public function validate(): FormAction
    {
        if (! $this->shouldValidate) {
            return $this;
        }

        foreach ($this->beforeValidationCallbacks as $callback) {
            $this->app->call($callback);
        }

        $validator = $this->getValidatorInstance();

        if ($validator->fails()) {
            $this->didValidationPass = false;

            $this->failedValidation($this->validator);
        } else {
            $this->didValidationPass = true;
        }

        $this->afterValidation(function () {
            $this->mapRequestInputsToPublicAttributes();
        });

        foreach ($this->afterValidationCallbacks as $callback) {
            $this->app->call($callback);
        }

        return $this;
    }

    public function afterValidation(callable $callback): FormAction
    {
        $this->afterValidationCallbacks[] = $callback;

        return $this;
    }

    public function onValidationFailure(callable $callback): FormAction
    {
        $this->onFailedValidationCallbacks[] = $callback;

        return $this;
    }

    public function failedValidation($validator): void
    {
        if (empty($this->onFailedValidationCallbacks)) {
            throw (new ValidationException($validator));
        }

        foreach ($this->onFailedValidationCallbacks as $callback) {
            $this->app->call($callback);
        }
    }

    public function withValidation(): FormAction
    {
        $this->shouldValidate = true;

        return $this;
    }

    public function withoutValidation(): FormAction
    {
        $this->shouldValidate = false;

        return $this;
    }

    public function validationPassed(): bool
    {
        return $this->didValidationPass;
    }

    public function getValidatorInstance(): Validator
    {
        if (isset($this->validator)) {
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
            $factory = $this->app->make(ValidationFactory::class);

            $this->validator = $factory->make(
                $this->request->all(),
                $this->getAllValidationRules(),
                $this->getAllValidationMessages(),
                $this->getAllValidationAttributes()
            );
        }

        return $this->validator;
    }

    public function validated(string|array|int $key = null, mixed $default = null): mixed
    {
        if(!isset($this->validator) && $this->validator instanceof Validator) {
            throw new \Exception('The validator must be set before calling validated()');
        }

        return data_get($this->validator->validated(), $key, $default);
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

    private function getRulesFromRuleAttributesOnPublicProperties(): array
    {
        return [];

        // TODO: implement this

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
}
