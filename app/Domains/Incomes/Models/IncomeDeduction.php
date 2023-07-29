<?php

namespace App\Domains\Incomes\Models;

use Database\Factories\IncomeDeductionFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Domains\Incomes\Models\IncomeDeduction
 *
 * @property int $id
 * @property string $ulid
 * @property int $income_id
 * @property string $name
 * @property int $amount
 * @property \Illuminate\Support\Carbon|null $start_date
 * @property \Illuminate\Support\Carbon|null $end_date
 * @property int|null $previous_id
 * @property string|null $change_reason
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Domains\Incomes\Models\Income $income
 * @property-read IncomeDeduction|null $previous
 *
 * @method static Builder|IncomeDeduction active()
 * @method static \Database\Factories\IncomeDeductionFactory factory($count = null, $state = [])
 * @method static Builder|IncomeDeduction newModelQuery()
 * @method static Builder|IncomeDeduction newQuery()
 * @method static Builder|IncomeDeduction query()
 * @method static Builder|IncomeDeduction whereActive($value)
 * @method static Builder|IncomeDeduction whereAmount($value)
 * @method static Builder|IncomeDeduction whereChangeReason($value)
 * @method static Builder|IncomeDeduction whereCreatedAt($value)
 * @method static Builder|IncomeDeduction whereEndDate($value)
 * @method static Builder|IncomeDeduction whereId($value)
 * @method static Builder|IncomeDeduction whereIncomeId($value)
 * @method static Builder|IncomeDeduction whereName($value)
 * @method static Builder|IncomeDeduction wherePreviousId($value)
 * @method static Builder|IncomeDeduction whereStartDate($value)
 * @method static Builder|IncomeDeduction whereUlid($value)
 * @method static Builder|IncomeDeduction whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class IncomeDeduction extends Model
{
    use HasFactory, HasUlids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ulid',
        'income_id',
        'name',
        'amount',
        'start_date',
        'end_date',
        'previous_id',
        'change_reason',
        'active',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'income_id' => 'integer',
        'start_date' => 'date',
        'end_date' => 'date',
        'previous_id' => 'integer',
        'active' => 'boolean',
    ];

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
        return IncomeDeductionFactory::new();
    }

    public function uniqueIds(): array
    {
        return ['ulid'];
    }

    /*
    |----------------------------------
    | Scopes
    |----------------------------------
    */
    public function scopeActive(Builder $query): void
    {
        $query->where('active', true);
    }

    /*
    |----------------------------------
    | Relationships
    |----------------------------------
    */
    public function income(): BelongsTo
    {
        return $this->belongsTo(Income::class);
    }

    public function previous(): BelongsTo
    {
        return $this->belongsTo(self::class, 'previous_id');
    }
}
