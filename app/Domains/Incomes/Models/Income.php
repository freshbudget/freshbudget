<?php

namespace App\Domains\Incomes\Models;

use App\Domains\Budgets\Models\Budget;
use App\Domains\Incomes\Events\IncomeCreated;
use App\Domains\Incomes\Events\IncomeDeleted;
use App\Domains\Shared\Enums\Frequency;
use App\Domains\Users\Models\User;
use Astrotomic\CachableAttributes\CachesAttributes;
use Database\Factories\IncomeFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Income extends Model
{
    use HasFactory, HasUlids, SoftDeletes, CachesAttributes;

    /**
     * The attributes that should be appended to the model.
     *
     * @var array
     */
    protected $appends = [
        'estimated_net_per_period',
        'estimated_net_per_month',
    ];

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
    ];

    /**
     * The attributes that should be cached.
     *
     * @var array
     */
    protected $cachableAttributes = [
        'estimated_net_per_period',
        'estimated_net_per_month',
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

    public function uniqueIds(): array
    {
        return ['ulid'];
    }

    /*
    |----------------------------------
    | Accessors
    |----------------------------------
    */
    protected function getEstimatedNetPerPeriodAttribute(): float
    {
        return $this->remember('estimated_net_per_period', 15, function (): float {

            $entitlements = $this->entitlements()->where('active', true)->sum('amount');

            $deductions = $this->deductions()->where('active', true)->sum('amount');

            $taxes = $this->taxes()->where('active', true)->sum('amount');

            $estimated = $entitlements - $taxes - $deductions;

            return round($estimated / 100, 2);

        });
    }

    protected function getEstimatedNetPerMonthAttribute(): float
    {
        return $this->remember('estimated_net_per_month', 15, function (): float {

            $totalEntitlements = 0;

            $entitlements = $this->entitlements()->where('active', true);

            // loop through each entitlement and calculate the monthly amount
            $entitlements->each(function ($entitlement) use (&$totalEntitlements) {

                // get the number of occurances in a month
                $occurances = $this->frequency->numberOfOccurancesInMonth();

                $entitlement->amount = $entitlement->amount * $occurances;

                $totalEntitlements += $entitlement->amount;
            });

            $deductions = $this->deductions()->where('active', true)->sum('amount');

            $taxes = $this->taxes()->where('active', true)->sum('amount');

            $estimated = $totalEntitlements - $taxes - $deductions;

            return round($estimated / 100, 2);

        });
    }

    /*
    |----------------------------------
    | Relationships
    |----------------------------------
    */
    public function activeDeductions(): HasMany
    {
        return $this->deductions()->where('active', true);
    }

    public function activeEntitlements(): HasMany
    {
        return $this->entitlements()->where('active', true);
    }

    public function activeTaxes(): HasMany
    {
        return $this->taxes()->where('active', true);
    }

    public function budget(): BelongsTo
    {
        return $this->belongsTo(Budget::class, 'budget_id');
    }

    public function deductions(): HasMany
    {
        return $this->hasMany(IncomeDeduction::class, 'income_id');
    }

    public function entitlements(): HasMany
    {
        return $this->hasMany(IncomeEntitlement::class, 'income_id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(IncomeType::class, 'type_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function taxes(): HasMany
    {
        return $this->hasMany(IncomeTax::class, 'income_id');
    }
}
