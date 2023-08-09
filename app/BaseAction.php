<?php

namespace app;

use App\Domains\Budgets\Models\Budget;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;
use Livewire\Attributes\Rule;

abstract class Action
{
    /**
     * The merged data from the request and any additional data
     *
     * @var array
     */
    protected $data = [];

    /**
     * Additional data that can be set on the action
     *
     * @var array
     */
    protected $additionalData = [];

    /**
     * The request instance
     *
     * @var Request
     */
    protected ?Request $request;

    public function __construct(Request $request = null)
    {
        if ($request) {
            $this->setRequest($request);
        }
    }

    /**
     * Set the request instance
     */
    public function setRequest(Request $request): self
    {
        $this->request = $request;

        $this->data = [];

        $this->data = array_merge($this->request->all(), $this->additionalData);

        return $this;
    }

    /**
     * Whether or not the action was successful
     *
     * @var bool
     */
    protected $success = false;

    /**
     * The number of attempts to run the action
     *
     * @var int
     */
    protected $attempts = 0;

    /**
     * Whether or not to redirect on validation failure
     *
     * @var bool
     */
    protected $redirectOnValidationFailure = true;

    /**
     * The url to redirect to on validation failure
     *
     * @var string
     */
    protected $redirectOnValidationFailureTo = null;

    /**
     * Whether or not to redirect on authorization failure
     *
     * @var bool
     */
    protected $redirectOnAuthorizationFailure = true;

    /**
     * Whether or not to throw an exception on authorization failure
     *
     * @var bool
     */
    protected $throwExceptionOnAuthorizationFailure = true;

    /**
     * Whether or not to validate the data
     *
     * @var bool
     */
    protected $shouldValidate = true;

    /**
     * Whether or not to authorize the action
     *
     * @var bool
     */
    protected $shouldAuthorize = true;

    /**
     * The result of the action
     *
     * @var mixed
     */
    protected $result = null;

    public static function make()
    {
        return new static;
    }

    /**
     * Set data on the action
     *
     * @param  string  $key
     * @param  mixed  $value
     */
    public function set($key, $value): self
    {
        // if the key is an array, merge it with the existing data
        if (is_array($key)) {
            $this->data = array_merge($this->data, $key);
        } else {
            $this->data[$key] = $value;
        }

        return $this;
    }

    /**
     * Get data from the action
     *
     * @param  string  $key
     * @param  mixed  $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return $this->data[$key] ?? $default;
    }

    /**
     * Check if the action has a key
     *
     * @param  string  $key
     */
    public function has($key): bool
    {
        return isset($this->data[$key]);
    }

    /**
     * Attempt to run the action
     *
     * @param  int  $maxAttempts
     */
    public function attempt($maxAttempts = 1): self
    {
        if ($this->authorize()) {
            // throw exception, or redirect?

            // throw a unauthorized exception
            throw new UnauthorizedException('You are not authorized to perform this action');
        }

        retry($maxAttempts, function () {
            $this->handle();

            $this->success = true;
        });

        return $this;
    }

    abstract public function handle();

    public function failedValidation(): void
    {
        //
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    abstract public function rules(): array;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [];
    }

    public function prepareForValidation(): void
    {
        //
    }

    public function validate()
    {
        if (method_exists($this, 'beforeValidation')) {
            app()->call([$this, 'beforeValidation']);
        }

        $rules = method_exists($this, 'rules') ? app()->call([$this, 'rules']) : [];

        $validator = validator($this->data, $rules);

        if (method_exists($this, 'afterValidation')) {
            app()->call([$this, 'afterValidation']);
        }
    }

    public function dontRedirectOnValidationFailure(): self
    {
        $this->redirectOnValidationFailure = false;

        return $this;
    }

    public function redirectOnValidationFailure(string $to = null): self
    {
        $this->redirectOnValidationFailure = true;

        $this->redirectOnValidationFailureTo = $to;

        return $this;
    }

    public function dontThrowAuthorizationException(): self
    {
        $this->throwExceptionOnAuthorizationFailure = false;

        return $this;
    }

    public function throwAuthorizationException(): self
    {
        $this->throwExceptionOnAuthorizationFailure = true;

        return $this;
    }

    public function withoutValidation(): self
    {
        $this->shouldValidate = false;

        return $this;
    }

    public function withValidation(): self
    {
        $this->shouldValidate = true;

        return $this;
    }

    public function withoutAuthorization(): self
    {
        $this->shouldAuthorize = false;

        return $this;
    }

    public function withAuthorization(): self
    {
        $this->shouldAuthorize = true;

        return $this;
    }

    protected $onValidationError = null;

    public function onValidationError(callable $callback): self
    {
        $this->onValidationError = $callback;

        return $this;
    }

    protected $onAuthorizationError = null;

    public function onAuthorizationError(callable $callback): self
    {
        $this->onAuthorizationError = $callback;

        return $this;
    }

    /**
     * Action lifecycle
     *
     * 1. Set the request
     * 2. Add additional data
     * 3. Call the attempt method
     * 4. Authorize the action, if required
     * 5. Validate the data, if required
     */
}

class CreateBudgetActionNew extends Action
{
    public function authorize(): bool
    {
        if (! $this->request->user()) {
            return false;
        }

        return $this->request->user()->can('create', Budget::class);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'personal' => ['required', 'boolean'],
            'user_id' => ['required', 'exists:'.'users:id'],
        ];
    }

    public function handle()
    {
        $budget = user()->ownedBudgets()->create([
            'name' => $this->get('name'),
            'personal' => $this->get('personal'),
        ]);

        return $budget;
    }
}

$action = CreateBudgetActionNew::make()
    ->setRequest(request())
    ->set('personal', true)
    ->set('user_id', user()->id)
    ->onAuthorizationError(function () {
        //
    })
    ->onValidationError(function () {
        //
    });

$action->authorize();

$action->validate();

$action = CreateBudgetActionNew::make()
    ->setRequest(request())
    ->set('personal', true)
    ->set('user_id', user()->id)
    ->withoutValidation()
    ->dontThrowAuthorizationException()
    ->dontRedirectOnValidationFailure()
    ->attempt(maxAttempts: 3);

/**
 * The base class will be called FormAction versus FormRequest
 * - Allows you to use the FormRequest outside of controllers
 * and align with the Action pattern
 */
class FormAction
{
    #[Rule(['required', 'string', 'min:3', 'max:255'])]
    public string $name;

    #[Rule(['required', 'boolean'])]
    public bool $personal;

    public function __construct(public Request $request)
    {
        $this->name = $request->input('name');
        $this->personal = $request->input('personal');
    }

    public function authorize(): bool
    {
        if (! $this->request->user()) {
            return false;
        }

        return $this->request->user()->can('create', Budget::class);
    }

    public function handle()
    {
        $budget = user()->ownedBudgets()->create([
            'name' => $this->name,
            'personal' => $this->personal,
        ]);

        return $budget;
    }
}

class Controller
{
    public function index(FormAction $action)
    {
        $action->onAuthorizationError(function () {
            //
        })->onValidationError(function () {
            //
        })->attempt(maxAttempts: 3);

        $action->budget;
    }
}
