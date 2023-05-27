<?php

namespace App\Domains\Budgets\Actions;

use App\Domains\Budgets\Models\Budget;
use App\Domains\Users\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CreateBudgetActionNew
{
    public array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public static function fromRequest(Request $request): self
    {
        return new self($request->only([
            'name',
        ]));
    }

    public function validate(Closure $fail): self
    {
        // create a validator
        $validator = validator($this->data, self::rules());

        // check if it fails
        if ($validator->fails()) {
            return $fail($validator);
        }

        return $this;
    }

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

    public function execute(User $owner): Budget
    {
        return $owner->ownedBudgets()->create($this->data);
    }
}
