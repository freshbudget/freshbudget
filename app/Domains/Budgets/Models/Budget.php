<?php

namespace App\Domains\Budgets\Models;

use App\Domains\Accounts\Models\Account;
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
/**
 * App\Domains\Budgets\Models\Budget
 *
 * @property int $id
 * @property string $ulid
 * @property string $name
 * @property string|null $currency
 * @property int $owner_id
 * @property bool $personal
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Income> $activeIncomes
 * @property-read int|null $active_incomes_count
 * @property-read User|null $deleter
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Income> $incomes
 * @property-read int|null $incomes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Budgets\Models\BudgetInvitation> $invitations
 * @property-read int|null $invitations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $members
 * @property-read int|null $members_count
 * @property-read User $owner
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Budgets\Models\BudgetInvitation> $pendingInvitations
 * @property-read int|null $pending_invitations_count
 * @method static \Database\Factories\BudgetFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Budget newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Budget newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Budget onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Budget query()
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget wherePersonal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Budget withoutTrashed()
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Account> $accounts
 * @property-read int|null $accounts_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Account> $activeAccounts
 * @property-read int|null $active_accounts_count
 * @mixin \Eloquent
 */

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
            $budget->members()->attach($budget->owner->id, [
                'role' => 'owner',
            ]);
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
    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class, 'budget_id');
    }

    public function activeAccounts(): HasMany
    {
        return $this->accounts()->active();
    }

    public function incomes(): HasMany
    {
        return $this->hasMany(Income::class, 'budget_id');
    }

    public function activeIncomes(): HasMany
    {
        return $this->incomes()->active();
    }

    public function deleter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'deleted_by');
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
