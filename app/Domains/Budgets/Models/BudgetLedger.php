<?php

namespace App\Domains\Budgets\Models;

use Database\Factories\BudgetLedgerFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Domains\Budgets\Models\BudgetLedger
 *
 * @property int $id
 * @property string $ulid
 * @property int $budget_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Domains\Budgets\Models\Budget $budget
 * @method static \Database\Factories\BudgetLedgerFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetLedger newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetLedger newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetLedger query()
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetLedger whereBudgetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetLedger whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetLedger whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetLedger whereUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetLedger whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BudgetLedger extends Model
{
    use HasFactory, HasUlids;

    /*
    |----------------------------------
    | Model Configuration
    |----------------------------------
    */
    public function getRouteKeyName()
    {
        return 'ulid';
    }

    public static function newFactory()
    {
        return BudgetLedgerFactory::new();
    }

    public function uniqueIds(): array
    {
        return ['ulid'];
    }

    /*
    |----------------------------------
    | Relationships
    |----------------------------------
    */
    public function budget(): BelongsTo
    {
        return $this->belongsTo(Budget::class);
    }
}
