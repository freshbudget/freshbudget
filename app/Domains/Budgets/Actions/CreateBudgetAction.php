<?php

namespace App\Domains\Budgets\Actions;

use App\Domains\Budgets\Models\Budget;
use App\Domains\Users\Models\User;
use Closure;
use Illuminate\Support\Str;

class CreateBudgetAction
{
    public static function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255',  function (string $attribute, mixed $value, Closure $fail) {
                if (Str::of($value)->ascii()->trim()->length() < 3) {
                    $fail("The {$attribute} must contain at least three ascii characters.");
                }
            }, ],
        ];
    }

    public function execute(array $data, User $owner): Budget
    {
        return $owner->ownedBudgets()->create($data);
    }
}
