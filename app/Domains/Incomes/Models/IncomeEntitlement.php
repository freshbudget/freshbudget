<?php

namespace App\Domains\Incomes\Models;

use Database\Factories\IncomeEntitlementFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Mpociot\Versionable\VersionableTrait;

/**
 * App\Domains\Incomes\Models\IncomeEntitlement
 *
 * @property int $id
 * @property string $ulid
 * @property int $income_id
 * @property string $name
 * @property int $amount
 * @property \Illuminate\Support\Carbon|null $start_date
 * @property \Illuminate\Support\Carbon|null $end_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Domains\Incomes\Models\Income $income
 * @property-write mixed $reason
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Mpociot\Versionable\Version> $versions
 * @property-read int|null $versions_count
 *
 * @method static \Database\Factories\IncomeEntitlementFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntitlement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntitlement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntitlement query()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntitlement whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntitlement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntitlement whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntitlement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntitlement whereIncomeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntitlement whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntitlement whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntitlement whereUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntitlement whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class IncomeEntitlement extends Model
{
    use HasFactory, HasUlids, VersionableTrait;

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
        'reason',
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
        return IncomeEntitlementFactory::new();
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
    public function income(): BelongsTo
    {
        return $this->belongsTo(Income::class);
    }
}
