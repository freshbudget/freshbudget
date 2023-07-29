<?php

namespace App\Domains\Budgets\Models;

use Database\Factories\BudgetStatisticFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Stats\Traits\HasStats;

/**
 * App\Domains\Budgets\Models\BudgetStatistic
 *
 * @property int $id
 * @property int $budget_id
 * @property string $model_type
 * @property int $model_id
 * @property string|null $type
 * @property int|null $value
 * @property string|null $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Domains\Budgets\Models\Budget $budget
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetStatistic decrements()
 * @method static \Database\Factories\BudgetStatisticFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetStatistic groupByPeriod(string $period)
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetStatistic increments()
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetStatistic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetStatistic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetStatistic query()
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetStatistic whereBudgetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetStatistic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetStatistic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetStatistic whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetStatistic whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetStatistic whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetStatistic whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetStatistic whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetStatistic whereValue($value)
 * @mixin \Eloquent
 */
class BudgetStatistic extends Model
{
    use HasFactory, HasStats;

    protected $fillable = [
        'budget_id',
        'model_type',
        'model_id',
        'type',
        'value',
        'name',
        'created_at',
        'updated_at',
    ];

    /*
    |----------------------------------
    | Model Configuration
    |----------------------------------
    */
    public static function newFactory()
    {
        return BudgetStatisticFactory::new();
    }

    /*
    |----------------------------------
    | Relationships
    |----------------------------------
    */
    public function budget()
    {
        return $this->belongsTo(Budget::class, 'budget_id');
    }
}
