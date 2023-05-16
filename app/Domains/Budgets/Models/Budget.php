<?php

namespace App\Domains\Budgets\Models;

use App\Domains\Budgets\Events\BudgetCreated;
use App\Domains\Budgets\Events\BudgetDeleted;
use App\Domains\Incomes\Models\Income;
use App\Domains\Users\Models\User;
use Database\Factories\BudgetFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Budget extends Model
{
    use HasFactory, HasUlids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ulid',
        'name',
        'currency',
        'personal',
        'deleted_by',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'owner_id' => 'integer',
        'personal' => 'boolean',
        'deleted_by' => 'integer',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => BudgetCreated::class,
        'deleted' => BudgetDeleted::class,
    ];

    /*
    |----------------------------------
    | Model Configuration
    |----------------------------------
    */
    protected static function booted(): void
    {
        static::created(function (Budget $budget) {
            $budget->members()->attach($budget->owner->id);
        });
    }

    public function getRouteKeyName()
    {
        return 'ulid';
    }

    public static function newFactory()
    {
        return BudgetFactory::new();
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
    public function deleter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    public function incomes(): HasMany
    {
        return $this->hasMany(Income::class, 'budget_id');
    }

    public function invitations(): HasMany
    {
        return $this->hasMany(BudgetInvitation::class, 'budget_id');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'budget_users', 'budget_id', 'user_id')->withTimestamps();
    }

    /*
    |--------------------------------------------------------------------------
    | Team Budget Functionality
    |--------------------------------------------------------------------------
    */
    public function addUser(User $user): void
    {
        $this->members()->attach($user->id);
    }

    public function hasUser(User $user): bool
    {
        return $this->members->contains($user) || $this->owner->is($user);
    }

    public function hasUserWithEmail(string $email): bool
    {
        return $this->members()->where('email', $email)->exists();
    }

    public function isOwnedBy(User $user): bool
    {
        return $this->owner->is($user);
    }

    public function removeUser(User $user): void
    {
        $this->members()->detach($user->id);
    }

    /**
     * Determine if the budget has any current users.
     * i.e. users that have the budget set as their current budget.
     * And optionally, exclude the given user.
     */
    public function hasCurrentUsers(User $user = null): bool
    {
        return $this->members()
            ->where('current_budget_id', $this->id)
            ->when($user, function ($query, $user) {
                $query->where('user_id', '!=', $user->id);
            })->exists();
    }
}
