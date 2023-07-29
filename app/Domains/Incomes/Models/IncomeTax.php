<?php

namespace App\Domains\Incomes\Models;

use App\Domains\Incomes\Presenters\IncomeTaxPresenter;
use Database\Factories\IncomeTaxFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Domains\Incomes\Models\IncomeTax
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
 * @property-read IncomeTax|null $previous
 *
 * @method static \Database\Factories\IncomeTaxFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeTax newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeTax newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeTax query()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeTax whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeTax whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeTax whereChangeReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeTax whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeTax whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeTax whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeTax whereIncomeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeTax whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeTax wherePreviousId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeTax whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeTax whereUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeTax whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class IncomeTax extends Model
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
        return IncomeTaxFactory::new();
    }

    public function presenter()
    {
        return new IncomeTaxPresenter($this);
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
