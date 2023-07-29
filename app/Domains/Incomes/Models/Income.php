<?php

namespace App\Domains\Incomes\Models;

use App\Domains\Budgets\Models\Budget;
use App\Domains\Incomes\Events\IncomeCreated;
use App\Domains\Incomes\Events\IncomeDeleted;
use App\Domains\Incomes\Presenters\IncomePresenter;
use App\Domains\Shared\Enums\Frequency;
use App\Domains\Users\Models\User;
use Database\Factories\IncomeFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Domains\Incomes\Models\Income
 *
 * @property int $id
 * @property string $ulid
 * @property int $budget_id
 * @property int|null $user_id
 * @property string $name
 * @property string|null $description
 * @property int|null $type_id
 * @property string|null $url
 * @property string|null $username
 * @property string|null $currency
 * @property Frequency|null $frequency
 * @property array|null $meta
 * @property bool $active
 * @property int|null $estimated_entitlements_per_period
 * @property int|null $estimated_taxes_per_period
 * @property int|null $estimated_deductions_per_period
 * @property int|null $estimated_net_per_period
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Incomes\Models\IncomeDeduction> $activeDeductions
 * @property-read int|null $active_deductions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Incomes\Models\IncomeTax> $activeTaxes
 * @property-read int|null $active_taxes_count
 * @property-read Budget $budget
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Incomes\Models\IncomeDeduction> $deductions
 * @property-read int|null $deductions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Incomes\Models\IncomeEntitlement> $entitlements
 * @property-read int|null $entitlements_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Incomes\Models\IncomeStatistic> $statistics
 * @property-read int|null $statistics_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Incomes\Models\IncomeTax> $taxes
 * @property-read int|null $taxes_count
 * @property-read \App\Domains\Incomes\Models\IncomeType|null $type
 * @property-read User|null $user
 *
 * @method static Builder|Income active()
 * @method static \Database\Factories\IncomeFactory factory($count = null, $state = [])
 * @method static Builder|Income newModelQuery()
 * @method static Builder|Income newQuery()
 * @method static Builder|Income onlyTrashed()
 * @method static Builder|Income query()
 * @method static Builder|Income whereActive($value)
 * @method static Builder|Income whereBudgetId($value)
 * @method static Builder|Income whereCreatedAt($value)
 * @method static Builder|Income whereCurrency($value)
 * @method static Builder|Income whereDeletedAt($value)
 * @method static Builder|Income whereDescription($value)
 * @method static Builder|Income whereEstimatedDeductionsPerPeriod($value)
 * @method static Builder|Income whereEstimatedEntitlementsPerPeriod($value)
 * @method static Builder|Income whereEstimatedNetPerPeriod($value)
 * @method static Builder|Income whereEstimatedTaxesPerPeriod($value)
 * @method static Builder|Income whereFrequency($value)
 * @method static Builder|Income whereId($value)
 * @method static Builder|Income whereMeta($value)
 * @method static Builder|Income whereName($value)
 * @method static Builder|Income whereTypeId($value)
 * @method static Builder|Income whereUlid($value)
 * @method static Builder|Income whereUpdatedAt($value)
 * @method static Builder|Income whereUrl($value)
 * @method static Builder|Income whereUserId($value)
 * @method static Builder|Income whereUsername($value)
 * @method static Builder|Income withTrashed()
 * @method static Builder|Income withoutTrashed()
 *
 * @mixin \Eloquent
 */
class Income extends Model
{
    use HasFactory, HasUlids, SoftDeletes, Prunable;

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => IncomeCreated::class,
        'deleted' => IncomeDeleted::class,
    ];

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
        'currency',
        'frequency',
        'meta',
        'active',
        'estimated_entitlements_per_period',
        'estimated_taxes_per_period',
        'estimated_deductions_per_period',
        'estimated_net_per_period',
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
        'frequency' => Frequency::class,
        'meta' => 'array',
        'active' => 'boolean',
        'estimated_entitlements_per_period' => 'integer',
        'estimated_taxes_per_period' => 'integer',
        'estimated_deductions_per_period' => 'integer',
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

    public function presenter(): IncomePresenter
    {
        return new IncomePresenter($this);
    }

    public function prunable(): Builder
    {
        return self::where('deleted_at', '<', now()->subDays(30));
    }

    public function uniqueIds(): array
    {
        return ['ulid'];
    }

    /*
    |----------------------------------
    | Scopes
    |----------------------------------
    */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('active', true);
    }

    /*
    |----------------------------------
    | Relationships
    |----------------------------------
    */

    /**
     * Cascade deletes when deleting a budget.
     */
    public function budget(): BelongsTo
    {
        return $this->belongsTo(Budget::class, 'budget_id');
    }

    /**
     * Goes to null if the user is deleted.
     * If the user is removed from the budget, goes to null.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Cascade deletes when deleting an income.
     */
    public function activeDeductions(): HasMany
    {
        return $this->deductions()->where('active', true);
    }

    /**
     * Cascade deletes when deleting an income.
     */
    public function deductions(): HasMany
    {
        return $this->hasMany(IncomeDeduction::class, 'income_id');
    }

    /**
     * Cascade deletes when deleting an income.
     */
    public function activeTaxes(): HasMany
    {
        return $this->taxes()->where('active', true);
    }

    /**
     * Cascade deletes when deleting an income.
     */
    public function taxes(): HasMany
    {
        return $this->hasMany(IncomeTax::class, 'income_id');
    }

    /**
     * Cascade deletes when deleting an income.
     */
    public function entitlements(): HasMany
    {
        return $this->hasMany(IncomeEntitlement::class, 'income_id');
    }

    public function statistics(): HasMany
    {
        return $this->hasMany(IncomeStatistic::class, 'income_id');
    }

    /**
     * Goes to null if the income type is deleted.
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(IncomeType::class, 'type_id');
    }
}
