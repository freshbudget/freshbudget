<?php

namespace App\Models;

use App\Concerns\ManagesMemberships;
use App\Events\Budgets\BudgetCreated;
use App\Events\Budgets\BudgetDeleted;
/**
 * App\Models\Budget
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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BudgetInvitation> $invitations
 * @property-read int|null $invitations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $members
 * @property-read int|null $members_count
 * @property-read User $owner
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BudgetInvitation> $pendingInvitations
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
 * @property-read \App\Models\BudgetLedger|null $ledger
 * @property-read \Illuminate\Database\Eloquent\Collection<int, AssetAccount> $assetAccounts
 * @property-read int|null $asset_accounts_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Expense> $expenses
 * @property-read int|null $expenses_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, Media> $media
 * @property-read int|null $media_count
 * @mixin \Eloquent
 */

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Budget extends Model implements HasMedia
{
    use HasFactory, HasUlids, InteractsWithMedia, ManagesMemberships, SoftDeletes;

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

            // create a ledger for the budget
            $budget->ledger()->create();
        });
    }

    public function getRouteKeyName()
    {
        return 'ulid';
    }

    public function uniqueIds(): array
    {
        return ['ulid'];
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
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

    public function assetAccounts(): HasMany
    {
        return $this->hasMany(AssetAccount::class, 'budget_id');
    }

    public function activeIncomes(): HasMany
    {
        return $this->incomes()->active();
    }

    public function deleter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class, 'budget_id');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function ledger(): HasOne
    {
        return $this->hasOne(BudgetLedger::class, 'budget_id');
    }
}
