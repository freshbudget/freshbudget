<?php

namespace App\Domains\Incomes\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Stats\Traits\HasStats;

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
