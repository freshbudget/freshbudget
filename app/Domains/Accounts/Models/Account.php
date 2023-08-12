<?php

namespace App\Domains\Accounts\Models;

use App\Domains\Accounts\Events\AccountCreated;
use App\Domains\Accounts\Events\AccountDeleted;
use App\Domains\Budgets\Models\Budget;
use App\Domains\Shared\Enums\AccountType;
use App\Domains\Shared\Enums\Currency;
use App\Domains\Shared\Enums\Frequency;
use App\Domains\Shared\Models\Institute;
use App\Domains\Users\Models\User;
use Database\Factories\AccountFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory, HasUlids, Prunable, SoftDeletes;

    protected $fillable = [
        'ulid',
        'budget_id',
        'user_id',
        'name',
        'description',
        'type',
        'subtype_id',
        'currency',
        'frequency',
        'url',
        'username',
        'institution_id',
        'color',
        'meta',
        'active',
    ];

    protected $casts = [
        'id' => 'integer',
        'budget_id' => 'integer',
        'user_id' => 'integer',
        'type' => AccountType::class,
        'subtype_id' => 'integer',
        'currency' => Currency::class,
        'frequency' => Frequency::class,
        'meta' => 'array',
        'active' => 'boolean',
    ];

    protected $dispatchesEvents = [
        'created' => AccountCreated::class,
        'deleted' => AccountDeleted::class,
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
        return AccountFactory::new();
    }

    public function prunable(): Builder
    {
        return self::where('deleted_at', '<=', now()->subDays(60));
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
     * Goes to null if the institute is deleted.
     */
    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institute::class, 'institution_id');
    }
}
