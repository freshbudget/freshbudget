<?php

namespace App\Domains\Incomes\Models;

use App\Domains\Incomes\Models\Income;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\IncomeDeductionFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'description',
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
