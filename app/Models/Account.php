<?php

namespace App\Models;

use App\Enums\AccountType;
use App\Enums\Currency;
use App\Enums\Frequency;
use App\Events\Accounts\AccountCreated;
use App\Events\Accounts\AccountDeleted;
use Database\Factories\AccountFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Account
 *
 * @property int $id
 * @property string $ulid
 * @property int $budget_id
 * @property int|null $user_id
 * @property string $name
 * @property string|null $description
 * @property AccountType|null $type
 * @property int|null $subtype_id
 * @property Currency|null $currency
 * @property Frequency|null $frequency
 * @property int|null $institution_id
 * @property string|null $url
 * @property string|null $username
 * @property string|null $color
 * @property array|null $meta
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Budget $budget
 * @property-read Institute|null $institution
 * @property-read User|null $user
 *
 * @method static Builder|Account active()
 * @method static \Database\Factories\AccountFactory factory($count = null, $state = [])
 * @method static Builder|Account newModelQuery()
 * @method static Builder|Account newQuery()
 * @method static Builder|Account onlyTrashed()
 * @method static Builder|Account query()
 * @method static Builder|Account whereActive($value)
 * @method static Builder|Account whereBudgetId($value)
 * @method static Builder|Account whereColor($value)
 * @method static Builder|Account whereCreatedAt($value)
 * @method static Builder|Account whereCurrency($value)
 * @method static Builder|Account whereDeletedAt($value)
 * @method static Builder|Account whereDescription($value)
 * @method static Builder|Account whereFrequency($value)
 * @method static Builder|Account whereId($value)
 * @method static Builder|Account whereInstitutionId($value)
 * @method static Builder|Account whereMeta($value)
 * @method static Builder|Account whereName($value)
 * @method static Builder|Account whereSubtypeId($value)
 * @method static Builder|Account whereType($value)
 * @method static Builder|Account whereUlid($value)
 * @method static Builder|Account whereUpdatedAt($value)
 * @method static Builder|Account whereUrl($value)
 * @method static Builder|Account whereUserId($value)
 * @method static Builder|Account whereUsername($value)
 * @method static Builder|Account withTrashed()
 * @method static Builder|Account withoutTrashed()
 *
 * @mixin \Eloquent
 */
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
    public function budget(): BelongsTo
    {
        return $this->belongsTo(Budget::class, 'budget_id');
    }

    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institute::class, 'institution_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
