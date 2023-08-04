<?php

namespace App\Domains\Accounts\Models;

use App\Domains\Budgets\Models\Budget;
use App\Domains\Shared\Enums\AccountType;
use App\Domains\Shared\Enums\Currency;
use App\Domains\Shared\Enums\Frequency;
use App\Domains\Users\Models\User;
use Database\Factories\AccountFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Account extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'ulid',
        'budget_id',
        'user_id',
        'name',
        'description',
        'type',
        'currency',
        'frequency',
        'url',
        'username',
        'institution',
        'color',
        'meta',
        'active',
    ];

    protected $casts = [
        'id' => 'integer',
        'budget_id' => 'integer',
        'user_id' => 'integer',
        'type' => AccountType::class,
        'frequency' => Frequency::class,
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
        return AccountFactory::new();
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
}

$income = Account::create([
    'name' => 'Salary',
    'description' => 'My monthly salary',
    'budget_id' => currentBudget()->id,
    'user_id' => user()->id,
    'type' => AccountType::REVENUE,
    'currency' => Currency::USD,
    'frequency' => Frequency::MONTHLY,
]);

