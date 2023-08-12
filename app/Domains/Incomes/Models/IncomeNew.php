<?php

namespace App\Domains\Incomes\Models;

use App\Domains\Accounts\Models\Account;
use App\Domains\Shared\Enums\AccountType;

class IncomeNew extends Account
{
    protected static function booted(): void
    {
        static::creating(function (IncomeNew $income) {
            $income->type = AccountType::REVENUE;
        });
    }
}
