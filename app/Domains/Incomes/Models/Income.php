<?php

namespace App\Domains\Incomes\Models;

use App\Domains\Accounts\Models\Account;
use App\Domains\Shared\Enums\AccountType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Domains\Incomes\Models\Income
 *
 * @property int $id
 * @property string $ulid
 * @property int $budget_id
 * @property int|null $user_id
 * @property string $name
 * @property string|null $description
 * @property AccountType|null $type
 * @property int|null $subtype_id
 * @property \App\Domains\Shared\Enums\Currency|null $currency
 * @property \App\Domains\Shared\Enums\Frequency|null $frequency
 * @property int|null $institution_id
 * @property string|null $url
 * @property string|null $username
 * @property string|null $color
 * @property array|null $meta
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Incomes\Models\IncomeDeduction> $activeDeductions
 * @property-read int|null $active_deductions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Incomes\Models\IncomeTax> $activeTaxes
 * @property-read int|null $active_taxes_count
 * @property-read \App\Domains\Budgets\Models\Budget $budget
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Incomes\Models\IncomeDeduction> $deductions
 * @property-read int|null $deductions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Incomes\Models\IncomeEntitlement> $entitlements
 * @property-read int|null $entitlements_count
 * @property-read \App\Domains\Shared\Models\Institute|null $institution
 * @property-read IncomeType|null $subtype
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Incomes\Models\IncomeTax> $taxes
 * @property-read int|null $taxes_count
 * @property-read \App\Domains\Users\Models\User|null $user
 *
 * @method static Builder|Account active()
 * @method static \Database\Factories\AccountFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Income newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Income newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Income onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Income query()
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereBudgetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereFrequency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereInstitutionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereSubtypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Income withoutTrashed()
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Incomes\Models\IncomeEntitlement> $activeEntitlements
 * @property-read int|null $active_entitlements_count
 *
 * @mixin \Eloquent
 */
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
    public function deductions(): HasMany
    {
        return $this->hasMany(IncomeDeduction::class, 'account_id');
    }

    public function activeDeductions(): HasMany
    {
        return $this->deductions()->where('active', true);
    }

    public function taxes(): HasMany
    {
        return $this->hasMany(IncomeTax::class, 'account_id');
    }

    public function activeTaxes(): HasMany
    {
        return $this->taxes()->where('active', true);
    }

    public function entitlements(): HasMany
    {
        return $this->hasMany(IncomeEntitlement::class, 'account_id');
    }

    public function activeEntitlements(): HasMany
    {
        return $this->entitlements()->where('active', true);
    }

    public function subtype(): BelongsTo
    {
        return $this->belongsTo(IncomeType::class, 'subtype_id');
    }
    // public function statistics(): HasMany
    // {
    //     return $this->hasMany(IncomeStatistic::class, 'income_id');
    // }

}
