<?php

namespace App\Domains\Incomes\Models;

use App\Domains\Budgets\Models\Budget;
use App\Domains\Incomes\Enums\IncomeFrequency;
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
        'frequency' => IncomeFrequency::class,
        'meta' => 'array',
        'active' => 'boolean',
    ];

    protected $appends = [
        'estimated_net_per_period',
    ];

    protected $cachableAttributes = [
        'estimated_net_per_period',
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
    | Accessors and Mutators
    |----------------------------------
    */
    protected function getEstimatedNetPerPeriodAttribute(): float
    {
        return $this->remember('estimated_net_per_period', 60, function (): float {

            $entitlements = $this->entitlements()->where('active', true)->sum('amount');

            $deductions = $this->deductions()->where('active', true)->sum('amount');

            $taxes = $this->taxes()->where('active', true)->sum('amount');

            $estimated = $entitlements - $taxes - $deductions;

            return round($estimated / 100, 2);

        });
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
