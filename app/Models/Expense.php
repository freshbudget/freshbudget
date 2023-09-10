<?php

namespace App\Models;

use App\Enums\AccountType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Expense
 *
 * @property int $id
 * @property string $ulid
 * @property int $budget_id
 * @property int|null $user_id
 * @property string $name
 * @property string|null $description
 * @property AccountType|null $type
 * @property int|null $subtype_id
 * @property \App\Enums\Currency|null $currency
 * @property \App\Enums\Frequency|null $frequency
 * @property int|null $institution_id
 * @property string|null $url
 * @property string|null $username
 * @property string|null $color
 * @property array|null $meta
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Budget $budget
 * @property-read \App\Models\Institute|null $institution
 * @property-read \App\Models\IncomeType|null $subtype
 * @property-read \App\Models\User|null $user
 *
 * @method static Builder|Account active()
 * @method static \Illuminate\Database\Eloquent\Builder|Expense newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Expense newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Expense onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Expense query()
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereBudgetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereFrequency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereInstitutionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereSubtypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Expense withoutTrashed()
 *
 * @mixin \Eloquent
 */
class Expense extends Account
{
    protected $table = 'accounts';

    protected static function booted(): void
    {
        static::creating(function (Expense $expense) {
            $expense->type = AccountType::EXPENSE;
        });

        static::addGlobalScope('type', function ($query) {
            $query->where('type', AccountType::EXPENSE);
        });
    }

    /*
    |----------------------------------
    | Relationships
    |----------------------------------
    */
    public function subtype(): BelongsTo
    {
        return $this->belongsTo(ExpenseType::class, 'subtype_id');
    }
}
