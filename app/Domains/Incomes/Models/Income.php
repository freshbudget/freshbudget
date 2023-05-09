<?php

namespace App\Domains\Incomes\Models;

use App\Domains\Budgets\Models\Budget;
use App\Models\User;
use Database\Factories\IncomeFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Income extends Model
{
    use HasFactory, HasUlids;

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
        'type_id',
        'description',
        'url',
        'username',
        'start_date',
        'end_date',
        'amount',
        'currency',
        'frequency_id',
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
        'type_id' => 'integer',
        'start_date' => 'date',
        'end_date' => 'date',
        'amount' => 'integer',
        'frequency_id' => 'integer',
        'meta' => 'array',
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
        return IncomeFactory::new();
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
        return $this->belongsTo(Budget::class, 'budget_id');
    }

    public function frequency(): BelongsTo
    {
        return $this->belongsTo(IncomeFrequency::class, 'frequency_id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(IncomeType::class, 'type_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
