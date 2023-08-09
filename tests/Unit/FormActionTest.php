<?php

use App\Domains\Shared\Enums\Currency;
use App\Domains\Users\Models\User;
use App\FormAction;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Config\Repository;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;
use Livewire\Attributes\Rule;

class CreateBudgetAction extends FormAction
{
    #[Rule(['required', 'string', 'max:255'])]
    public string $name;

    #[Rule(['required', 'boolean'])]
    public bool $personal;

    #[Rule(['required', 'exists:users,id'])]
    public User $user;

    #[Rule(['required', new Enum(Currency::class)])]
    public Currency $currency;

    public function handle()
    {
        $budget = $this->user->ownedBudgets()->create([
            'name' => $this->name,
            'personal' => $this->personal,
            'currency' => $this->currency,
        ]);

        return $budget;
    }
}

// test the action has the ability to set additional data in the request
test('the action can set additional data in the request', function () {
    $action = new class extends FormAction
    {
        //
    };

    $action->set('name', 'Personal Budget');

    expect($action->has('name'))->toBeTrue();
    expect($action->request->has('name'))->toBeTrue();
    expect($action->get('name'))->toBe('Personal Budget');
});

// test the action can set additional data in the request using the array syntax
test('the action can set additional data in the request using the array syntax', function () {
    $action = new class extends FormAction
    {
        //
    };

    $action->set([
        'name' => 'Personal Budget',
        'personal' => true,
    ]);

    expect($action->has('name'))->toBeTrue();
    expect($action->hasAny(['name', 'personal']))->toBeTrue();
    expect($action->hasAll(['name', 'personal']))->toBeTrue();
    expect($action->hasAll(['name', 'personal', 'currency']))->toBeFalse();
});

// test the action has the ability to set additional data in the request using a callback
test('the action can set additional data in the request using a callback', function () {
    $user = User::factory()->create();

    $action = new class extends FormAction
    {
        //
    };

    $action->set('admin', function () use ($user) {
        return $user;
    });

    expect($action->has('admin'))->toBeTrue();
    expect($action->get('admin'))->toBe($user);
});

test('the action can set additional data in the request using callback with DI', function () {

    config(['app.name' => 'Laravel']);

    class TestService
    {
        public function __construct(public Repository $config)
        {
            //
        }

        public function test()
        {
            return $this->config->get('app.name');
        }
    }

    $action = new class extends FormAction
    {
        //
    };

    $action->set('name', function (TestService $service) {
        return $service->test();
    });

    expect($action->has('name'))->toBeTrue();
    expect($action->get('name'))->toBe('Laravel');
});

// the action will proxy missing methods to the request, if the method exists
test('the action will proxy missing methods to the request, if the method exists', function () {
    $action = new class extends FormAction
    {
        //
    };

    $action->set('name', 'Personal Budget');

    expect($action->exists('name'))->toBeTrue();
});

// the action will throw an exception if the method does not exist on the action or the request
test('the action will throw an exception if the method does not exist on the action or the request', function () {
    $action = new class extends FormAction
    {
        //
    };

    $action->foo();
})->throws(BadMethodCallException::class);

// the action will proxy missing properties to the request, if the property exists
test('the action will proxy missing properties to the request, if the property exists', function () {
    $request = request()->merge(['fooBarKey' => 'Foo']);

    $action = new class extends FormAction
    {
        //
    };

    $action->setRequest($request);

    expect($action->fooBarKey)->toBe('Foo');
});

// the action will throw an exception if the property does not exist on the action or the request
test('the action will throw an exception if the property does not exist on the action or the request', function () {

    $action = new class extends FormAction
    {
        //
    };

    $action->foo;

})->throws(BadMethodCallException::class);

// test the action has a default authorize method and it returns true
test('the action has a default authorize method and it returns true', function () {
    $action = new class extends FormAction
    {
        //
    };

    expect($action->authorize())->toBeTrue();
});

// test the action has a attempt method
test('the action has a default attempt method', function () {
    $action = new class extends FormAction
    {
        //
    };

    expect(method_exists($action, 'attempt'))->toBeTrue();
});

// test the attempt method cannot be less than 1
test('the attempt method cannot be less than 1', function () {
    $action = new class extends FormAction
    {
        //
    };

    $action->attempt(0);
})->throws(InvalidArgumentException::class);

// the action has a default failedAuthorization method, which throws a AuthorizationException
test('the action has a default failedAuthorization method, which throws a AuthorizationException', function () {

    $action = new class extends FormAction
    {
        //
    };

    expect(method_exists($action, 'failedAuthorization'))->toBeTrue();

    // use reflection to make the method public
    $method = (new ReflectionClass($action))->getMethod('failedAuthorization');
    $method->setAccessible(true);
    $method->invoke($action);

})->throws(AuthorizationException::class);

// test the action allows you to register an onFailedAuthorization callback
test('the action allows you to register an onFailedAuthorization callback', function () {

    $action = new class extends FormAction
    {
        //
    };

    $action->onFailedAuthorization(function () {
        throw new Exception('Authorization failed');
    });

    $method = (new ReflectionClass($action))->getMethod('failedAuthorization');
    $method->setAccessible(true);
    $method->invoke($action);

})->throws(Exception::class, 'Authorization failed');

// the action allows you to register beforeAuthorization callbacks
test('the action allows you to register beforeAuthorization callbacks', function () {

    $action = new class extends FormAction
    {
        //
    };

    $action->beforeAuthorization(function () {
        throw new Exception('Before authorization');
    });

    $action->attempt();

})->throws(Exception::class, 'Before authorization');

// the action allows you to register afterAuthorization callbacks
test('the action allows you to register afterAuthorization callbacks', function () {

    $action = new class extends FormAction
    {
        //
    };

    $action->afterAuthorization(function () {
        throw new Exception('After authorization');
    });

    $action->attempt();

})->throws(Exception::class, 'After authorization');

// the action allows you to replace existing data in the request
test('the action allows you to replace existing data in the request', function () {

    $request = request()->merge(['name' => 'Personal Budget']);

    $action = new class extends FormAction
    {
        //
    };

    $action->setRequest($request);

    // array syntax
    $action->set(['name', 'Personal Budget 2']);
    expect($action->get('name'))->toBe('Personal Budget');

    // key, value syntax
    $action->set('name', 'Personal Budget 2');
    expect($action->get('name'))->toBe('Personal Budget');

    // replace method
    $action->replace('name', 'Personal Budget 2');

    expect($action->get('name'))->toBe('Personal Budget 2');
});

// the getAllValidationRules discovers rules from the rules method
test('the getAllValidationRules discovers rules from the rules method', function () {

    $action = new class extends FormAction
    {
        public function rules(): array
        {
            return [
                'name' => 'required',
            ];
        }
    };

    expect($action->getAllValidationRules())->toBe([
        'name' => 'required',
    ]);
});

// the getAllValidationRules discovers rules from the rules property
test('the getAllValidationRules discovers rules from the rules property', function () {

    $action = new class extends FormAction
    {
        public $rules = [
            'name' => 'required',
        ];
    };

    expect($action->getAllValidationRules())->toBe([
        'name' => 'required',
    ]);
});

// the getAllValidationRules discovers rules from the rules method and property
test('the getAllValidationRules discovers rules from the rules method and property', function () {

    $action = new class extends FormAction
    {
        public $rules = [
            'name' => 'required',
        ];

        public function rules(): array
        {
            return [
                'email' => 'required',
            ];
        }
    };

    expect($action->getAllValidationRules())->toBe([
        'name' => 'required',
        'email' => 'required',
    ]);
});

// the getAllValidationRules discovers rules from the rules method and property, the method takes precedence
test('the getAllValidationRules discovers rules from the rules method and property, the method takes precedence', function () {

    $action = new class extends FormAction
    {
        public $rules = [
            'name' => 'required',
        ];

        public function rules(): array
        {
            return [
                'name' => 'required|email',
            ];
        }
    };

    expect($action->getAllValidationRules())->toBe([
        'name' => 'required|email',
    ]);
});

// the action provides a default validation rules method
test('the action provides a default validation rules method', function () {

    $action = new class extends FormAction
    {
        //
    };

    expect($action->rules())->toBe([]);
});

// the getAllMessages discovers messages from the messages method
test('the getAllMessages discovers messages from the messages method', function () {

    $action = new class extends FormAction
    {
        public function messages(): array
        {
            return [
                'name.required' => 'The name is required',
            ];
        }
    };

    expect($action->getAllValidationMessages())->toBe([
        'name.required' => 'The name is required',
    ]);
});

// the getAllMessages discovers messages from the messages property
test('the getAllMessages discovers messages from the messages property', function () {

    $action = new class extends FormAction
    {
        public $messages = [
            'name.required' => 'The name is required',
        ];
    };

    expect($action->getAllValidationMessages())->toBe([
        'name.required' => 'The name is required',
    ]);
});

// the getAllMessages discovers messages from the messages method and property
test('the getAllMessages discovers messages from the messages method and property', function () {

    $action = new class extends FormAction
    {
        public $messages = [
            'name.required' => 'The name is required',
        ];

        public function messages(): array
        {
            return [
                'email.required' => 'The email is required',
            ];
        }
    };

    expect($action->getAllValidationMessages())->toBe([
        'name.required' => 'The name is required',
        'email.required' => 'The email is required',
    ]);
});

// the getAllMessages discovers messages from the messages method and property, the method takes precedence
test('the getAllMessages discovers messages from the messages method and property, the method takes precedence', function () {

    $action = new class extends FormAction
    {
        public $messages = [
            'name.required' => 'The name is required',
        ];

        public function messages(): array
        {
            return [
                'name.required' => 'The name is required 2',
                'email.required' => 'The email is required',
            ];
        }
    };

    expect($action->getAllValidationMessages())->toBe([
        'name.required' => 'The name is required 2',
        'email.required' => 'The email is required',
    ]);
});

// the action provides a default messages method
test('the action provides a default messages method', function () {

    $action = new class extends FormAction
    {
        //
    };

    expect(method_exists($action, 'messages'))->toBeTrue();
    expect($action->messages())->toBe([]);
});

// the getAllValidationAttributes discovers attributes from the attributes method
test('the getAllValidationAttributes discovers attributes from the attributes method', function () {

    $action = new class extends FormAction
    {
        public function attributes(): array
        {
            return [
                'name' => 'Name',
            ];
        }
    };

    expect($action->getAllValidationAttributes())->toBe([
        'name' => 'Name',
    ]);
});

// the getAllValidationAttributes discovers attributes from the attributes property
test('the getAllValidationAttributes discovers attributes from the attributes property', function () {

    $action = new class extends FormAction
    {
        public $attributes = [
            'name' => 'Name',
        ];
    };

    expect($action->getAllValidationAttributes())->toBe([
        'name' => 'Name',
    ]);
});

// the getAllValidationAttributes discovers attributes from the attributes method and property
test('the getAllValidationAttributes discovers attributes from the attributes method and property', function () {

    $action = new class extends FormAction
    {
        public $attributes = [
            'name' => 'Name',
        ];

        public function attributes(): array
        {
            return [
                'email' => 'Email',
            ];
        }
    };

    expect($action->getAllValidationAttributes())->toBe([
        'name' => 'Name',
        'email' => 'Email',
    ]);
});

// the getAllValidationAttributes discovers attributes from the attributes method and property, the method takes precedence
test('the getAllValidationAttributes discovers attributes from the attributes method and property, the method takes precedence', function () {

    $action = new class extends FormAction
    {
        public $attributes = [
            'name' => 'Name',
        ];

        public function attributes(): array
        {
            return [
                'name' => 'Name 2',
                'email' => 'Email',
            ];
        }
    };

    expect($action->getAllValidationAttributes())->toBe([
        'name' => 'Name 2',
        'email' => 'Email',
    ]);
});

// the action provides a default attributes method
test('the action provides a default attributes method', function () {

    $action = new class extends FormAction
    {
        //
    };

    expect(method_exists($action, 'attributes'))->toBeTrue();
    expect($action->attributes())->toBe([]);
});

// the action has a default failedValidation method, which throws a ValidationException
// test('the action has a default failedValidation method, which throws a ValidationException', function () {

//     $action = new class extends FormAction
//     {
//         //
//     };

//     expect(method_exists($action, 'failedValidation'))->toBeTrue();

//     // use reflection to make the method public
//     $method = (new ReflectionClass($action))->getMethod('failedValidation');
//     $method->setAccessible(true);
//     $method->invoke($action);

// })->throws(ValidationException::class);
