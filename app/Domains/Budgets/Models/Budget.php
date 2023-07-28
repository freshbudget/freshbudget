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
use Illuminate\Database\Eloquent\SoftDeletes;

class Budget extends Model
{
    use HasFactory, HasUlids, SoftDeletes;

    protected $fillable = [
        'ulid',
        'name',
        'currency',
        'personal',
        'deleted_by',
    ];

    protected $casts = [
        'id' => 'integer',
        'owner_id' => 'integer',
        'personal' => 'boolean',
        'deleted_by' => 'integer',
    ];

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
    public function activeIncomes(): HasMany
    {
        return $this->incomes()->active();
    }

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

    public function pendingInvitations(): HasMany
    {
        return $this->invitations()->where('state', BudgetInvitation::STATE_PENDING);
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'budget_users', 'budget_id', 'user_id')->withTimestamps();
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Team Budget Functionality
    |--------------------------------------------------------------------------
    */
    public function addMember(User $user): void
    {
        $this->members()->attach($user->id);
    }

    public function hasMember(User $user): bool
    {
        return $this->members->contains($user) || $this->owner->is($user);
    }

    public function hasMemberWithEmail(string $email): bool
    {
        return $this->members()->where('email', $email)->exists();
    }

    public function isOwnedBy(User $user): bool
    {
        return $this->owner->is($user);
    }

    public function removeMember(User $user): void
    {
        // check if they are the owner of any incomes in the budget, if so set to null
        $this->incomes()->where('user_id', $user->id)->update([
            'user_id' => null,
        ]);

        $this->members()->detach($user->id);
    }

    public function hasCurrentMembers(User $exclude = null): bool
    {
        return $this->members()
            ->where('current_budget_id', $this->id)
            ->when($exclude, function ($query, $user) {
                $query->where('user_id', '!=', $user->id);
            })->exists();
    }
}
