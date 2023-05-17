<?php

namespace App\Domains\Incomes\Models;

use App\Domains\Budgets\Models\Budget;
use App\Domains\Users\Models\User;
use Carbon\Carbon;
use Database\Factories\IncomeFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'currency',
        'frequency_id',
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
        'frequency_id' => 'integer',
        'meta' => 'array',
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

    public function entitlements(): HasMany
    {
        return $this->hasMany(IncomeEntitlement::class, 'income_id')->where('active', true);
    }

    public function totalEntitlementPerPeriod(): int
    {
        return $this->entitlements()->sum('amount');
    }

    public function totalEstimatedEntitlementPerMonth()
    {
        if ($this->frequency->abbr === 'monthly') {

            // this is a monthly income, so we can just return the total entitlement per period
            return $this->totalEntitlementPerPeriod();

        }

        // this is not a monthly income, so we need to calculate the monthly entitlement
        if ($this->frequency->abbr === 'weekly') {

            // need to know how many weeks are in the current month
            $weeksInMonth = Carbon::now();

            // this is a weekly income so we need to multiply the total entitlement per period by the number of weeks in the current month
            return $this->totalEntitlementPerPeriod() * $weeksInMonth;
        }

        if ($this->frequency->abbr === 'bi-weekly') {
            // this is a bi-weekly income so we need to multiply the total entitlement per period by 26 and divide by 12
            return ($this->totalEntitlementPerPeriod() * 26) / 12;
        }

        if ($this->frequency->abbr === 'one-time') {
            // this is a one-time income so we need to return 0 if the start date is null or is not in the current month and year
            if ($this->start_date === null || $this->start_date->month !== Carbon::now()->month || $this->start_date->year !== Carbon::now()->year) {
                return 0;
            }

            // otherwise, we can return the total entitlement per period
            return $this->totalEntitlementPerPeriod();
        }

        if ($this->frequency->abbr === 'irregular') {
            // this is an irregular income so we need to return 0
            return 0;
        }
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
