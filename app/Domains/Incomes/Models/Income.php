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
