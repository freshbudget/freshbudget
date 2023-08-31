<?php

namespace App\Domains\Incomes\Models;

use Database\Factories\IncomeEntryFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Domains\Incomes\Models\IncomeEntry
 *
 * @property int $id
 * @property string $ulid
 * @property int $income_id
 * @property \Illuminate\Support\Carbon $date
 * @property array $entitlements
 * @property array $taxes
 * @property array $deductions
 * @property int $entitlements_total
 * @property int $taxes_total
 * @property int $deductions_total
 * @property int $net_income
 * @property string|null $notes
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Domains\Incomes\Models\Income $income
 *
 * @method static \Database\Factories\IncomeEntryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntry query()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntry whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntry whereDeductions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntry whereDeductionsTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntry whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntry whereEntitlements($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntry whereEntitlementsTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntry whereIncomeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntry whereNetIncome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntry whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntry whereTaxes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntry whereTaxesTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntry whereUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntry whereUpdatedAt($value)
 *
 * @property int $account_id
 *
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntry whereAccountId($value)
 *
 * @mixin \Eloquent
 */
class IncomeEntry extends Model
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
        'date',
        'entitlements',
        'taxes',
        'deductions',
        'entitlements_total',
        'taxes_total',
        'deductions_total',
        'net_income',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'income_id' => 'integer',
        'date' => 'date',
        'entitlements' => 'array',
        'taxes' => 'array',
        'deductions' => 'array',
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
        return IncomeEntryFactory::new();
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
