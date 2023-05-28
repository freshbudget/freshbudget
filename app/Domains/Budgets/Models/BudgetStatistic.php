<?php

namespace App\Domains\Budgets\Models;

use Database\Factories\BudgetStatisticFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Stats\Traits\HasStats;

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
