<?php

namespace App\Domains\Incomes\Models;

use App\Domains\Accounts\Models\Account;
use App\Domains\Shared\Enums\AccountType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Income extends Account
{
    protected static function booted(): void
    {
        static::creating(function (IncomeNew $income) {
            $income->type = AccountType::REVENUE;
        });
    }

    /*
    |----------------------------------
    | OLD Relationships
    |----------------------------------
    */
    /**
     * Cascade deletes when deleting an income.
     */
    public function activeDeductions(): HasMany
    {
        return $this->deductions()->where('active', true);
    }

    /**
     * Cascade deletes when deleting an income.
     */
    public function deductions(): HasMany
    {
        return $this->hasMany(IncomeDeduction::class, 'account_id');
    }

    /**
     * Cascade deletes when deleting an income.
     */
    public function activeTaxes(): HasMany
    {
        return $this->taxes()->where('active', true);
    }

    /**
     * Cascade deletes when deleting an income.
     */
    public function taxes(): HasMany
    {
        return $this->hasMany(IncomeTax::class, 'account_id');
    }

    /**
     * Cascade deletes when deleting an income.
     */
    public function entitlements(): HasMany
    {
        return $this->hasMany(IncomeEntitlement::class, 'account_id');
    }

    /**
     * Goes to null if the income type is deleted.
     */
    public function subtype(): BelongsTo
    {
        return $this->belongsTo(IncomeType::class, 'subtype_id');
    }
}
