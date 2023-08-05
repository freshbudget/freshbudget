<?php

namespace App\Domains\Budgets\Data;

use App\Domains\Shared\Enums\Currency;
use App\Domains\Users\Models\User;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Data;

class BudgetData extends Data
{
    public function __construct(
        #[Min(3), Max(255)]
        public string $name,
        public ?Currency $currency,
        public User $owner,
        public bool $personal = false,
    ) {
    }
}
