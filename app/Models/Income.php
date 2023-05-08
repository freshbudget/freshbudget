<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Income extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ulid',
        'budget_id',
        'user_id',
        'name',
        'description',
        'url',
        'username',
        'start_date',
        'end_date',
        'amount',
        'currency',
        'meta',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'budget_id' => 'integer',
        'user_id' => 'integer',
        'start_date' => 'date',
        'end_date' => 'date',
        'meta' => 'array',
    ];

    public function incomeTypeIncomeFrequency(): BelongsTo
    {
        return $this->belongsTo(IncomeTypeIncomeFrequency::class);
    }

    public function budget(): BelongsTo
    {
        return $this->belongsTo(Budget::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\BudgetUser::class);
    }
}
