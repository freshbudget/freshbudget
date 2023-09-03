<?php

namespace App\Models;

use App\Enums\AccountType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\AssetAccount
 *
 * @property int $id
 * @property string $ulid
 * @property int $budget_id
 * @property int|null $user_id
 * @property string $name
 * @property string|null $description
 * @property AccountType|null $type
 * @property int|null $subtype_id
 * @property \App\Enums\Currency|null $currency
 * @property \App\Enums\Frequency|null $frequency
 * @property int|null $institution_id
 * @property string|null $url
 * @property string|null $username
 * @property string|null $color
 * @property array|null $meta
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Budget $budget
 * @property-read \App\Models\Institute|null $institution
 * @property-read \App\Models\AssetAccountType|null $subtype
 * @property-read \App\Models\User|null $user
 *
 * @method static Builder|Account active()
 * @method static \Database\Factories\AccountFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount whereBudgetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount whereFrequency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount whereInstitutionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount whereSubtypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount whereUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount withoutTrashed()
 *
 * @mixin \Eloquent
 */
class AssetAccount extends Account
{
    protected $table = 'accounts';

    protected static function booted(): void
    {
        static::creating(function (AssetAccount $account) {
            $account->type = AccountType::ASSET;
        });

        static::addGlobalScope('type', function ($query) {
            $query->where('type', AccountType::ASSET);
        });
    }

    /*
    |----------------------------------
    | Relationships
    |----------------------------------
    */
    public function subtype(): BelongsTo
    {
        return $this->belongsTo(AssetAccountType::class, 'subtype_id');
    }
}
