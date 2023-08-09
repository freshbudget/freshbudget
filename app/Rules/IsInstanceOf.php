<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class IsInstanceOf implements ValidationRule
{
    public function __construct(protected string $type)
    {
        //
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! $value instanceof $this->type) {
            $fail("The $attribute must be an instance of {$this->type}.");
        }
    }
}
