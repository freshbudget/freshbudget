# Laravel Form Actions

This package is what would happen if Laravel Livewire, Spatie's Laravel Data, and Laravel's Form Requests all had a child.

## Installation

You can install this package using composer by running the command below. You can check it out on packagist by visiting this page: [https://packagist.org](https://packagist.org)

```bash
composer require statix-php/laravel-form-actions
```

## Usage

### Create new Actions

```bash
php artisan make:form-action CreateTeamAction
# or 
php artisan make:form-action "create team action" # Will be converted to EasyToTypeName
```

Your default action will be similiar to the class shown below.

```php
<?php

namespace App\FormActions;

use FormAction;

class CreateTeamAction extends FormAction
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            //
        ];
    }

    public function __invoke()
    {
        // 
    }
}
```

### Action Lifecycle

When the `attempt` method is called, the following actions occur

- If authorization is enabled
    - The `beforeAuthorization` callbacks are called
    - The `authorize` method is called
    - The `afterAuthorization` callbacks are called
- If validation is enabled
    - the `beforeAuthorization` callbacks are called
    - the `validate` method is called
    - the `afterAuthorization` callbacks are called
- The `handle`, `execute`, or `__invoke` method is called, this should be the primary purpose of your action
- The result of your method is stored in the `result` property

### Action Authorization

You can create a public authorize function to specific logic to determine if the action should be authorized. 

```php
public function authorize(): bool
{
    return  $this->user()->can('create', Team::class);
}
```

> If you do not specify a custom `authorize` method, actions will be authorized by default.

If you need to perform some action before authorization is checked, you can utilize the `beforeAuthorization` method. You can call this method multiple times and all callbacks will be ran.

```php
$action->beforeAuthorization(function() {
    // do some work
})
```

If you need to perform some action after authorization has passed and before validation, you can utilize the `afterAuthorization` method. You can call this method multiple times and all callbacks will be ran.

```php
$action->afterAuthorization(function() {
    // do some work
})
```

## Contributing

Contributions are welcome and will be fully credited!

### Style Guide

- We use Laravel Pint to standardize coding style, when we merge a pull request a workflow will be triggered to fix any styling issues. 
- You can help the review process go faster by running Pint before you create a pull request. 

```bash
composer format
```

### Testing

- We use Laravel Pest for writing tests.
- Failing tests are welcome in pull requests if you cannot implement the feature/fix yourself.
- Passing tests are required for new features, this does not guarantee the PR will be merged, but will increase the probablity. 

```bash
./vendor/bin/pest
```

## Inspirations

- Laravel Livewire by Caleb Porzio
- Laravel Data by Spatie
- Laravel Form Requests 
- Laravel Actions by Loris

## Credits

- Wyatt Castaneda