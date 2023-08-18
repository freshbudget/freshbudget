<?php

namespace App\Domains\Incomes\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Stats\Traits\HasStats;

/**
 * App\Domains\Incomes\Models\IncomeStatistic
 *
 * @property int $id
 * @property int $income_id
 * @property string|null $name
 * @property string|null $type
 * @property int|null $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Domains\Incomes\Models\Income $income
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatistic decrements()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatistic groupByPeriod(string $period)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatistic increments()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatistic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatistic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatistic query()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatistic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatistic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatistic whereIncomeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatistic whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatistic whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatistic whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatistic whereValue($value)
 * @mixin \Eloquent
 */
class IncomeStatistic extends Model
{
    use HasFactory, HasStats;

    protected $fillable = [
        'income_id',
        'name',
        'type',
        'value',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'value' => 'integer',
    ];

    /*
    |----------------------------------
    | Relationships
    |----------------------------------
    */
    public function income()
    {
        return $this->belongsTo(Income::class, 'income_id');
    }
}
