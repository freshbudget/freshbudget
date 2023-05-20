<?php

namespace App\Domains\Incomes\Models;

use App\Domains\Budgets\Models\Budget;
use App\Domains\Users\Models\User;
use Database\Factories\IncomeFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Income extends Model
{
    use HasFactory, HasUlids, SoftDeletes;

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

    public function deductions(): HasMany
    {
        return $this->hasMany(IncomeDeduction::class, 'income_id')->where('active', true);
    }

    public function entitlements(): HasMany
    {
        return $this->hasMany(IncomeEntitlement::class, 'income_id')->where('active', true);
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

    public function estimatedNetAmountPerPeriod(): string
    {
        $entitlements = $this->entitlements()->where('active', true)->sum('amount');

        $taxes = $this->taxes()->where('active', true)->sum('amount');

        $deductions = $this->deductions()->where('active', true)->sum('amount');

        $estimated = $entitlements - $taxes - $deductions;

        return number_format($estimated / 100, 2);
    }

    public function taxes(): HasMany
    {
        return $this->hasMany(IncomeTax::class, 'income_id')->where('active', true);
    }

    // TODO: Need to add a method to get the estimated amount per given period (month, week, etc.) based on the frequency and the amount
}
