<?php

namespace App\Domains\Incomes\Models;

use App\Domains\Accounts\Models\Account;
use App\Domains\Shared\Enums\AccountType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Income extends Account
{
    protected $table = 'accounts';

    protected static function booted(): void
    {
        static::creating(function (Income $income) {
            $income->type = AccountType::REVENUE;
        });

        static::addGlobalScope('type', function ($query) {
            $query->where('type', AccountType::REVENUE);
        });
    }

    /**
     * OLD
     * // fillable
     * 'estimated_entitlements_per_period',
     * 'estimated_taxes_per_period',
     * 'estimated_deductions_per_period',
     * 'estimated_net_per_period',
     * 
     * // casts
     * 'estimated_entitlements_per_period' => 'integer',
     * 'estimated_taxes_per_period' => 'integer',
     * 'estimated_deductions_per_period' => 'integer',
     * 
     * // presenters
     */

    /*
    |----------------------------------
    | Relationships
    |----------------------------------
    */
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
    public function activeDeductions(): HasMany
    {
        return $this->deductions()->where('active', true);
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
    public function activeTaxes(): HasMany
    {
        return $this->taxes()->where('active', true);
    }

    /**
     * Cascade deletes when deleting an income.
     */
    public function entitlements(): HasMany
    {
        return $this->hasMany(IncomeEntitlement::class, 'account_id');
    }

    // public function statistics(): HasMany
    // {
    //     return $this->hasMany(IncomeStatistic::class, 'income_id');
    // }

    /**
     * Goes to null if the income type is deleted.
     */
    public function subtype(): BelongsTo
    {
        return $this->belongsTo(IncomeType::class, 'subtype_id');
    }
}
