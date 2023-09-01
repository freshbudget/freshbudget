<?php

namespace App\Domains\Accounts\Models;

use Database\Factories\AccountLedgerFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Domains\Accounts\Models\AccountLedger
 *
 * @property int $id
 * @property string $ulid
 * @property int $account_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Account $account
 *
 * @method static \Database\Factories\AccountLedgerFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|AccountLedger newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountLedger newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountLedger query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountLedger whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountLedger whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountLedger whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountLedger whereUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountLedger whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class AccountLedger extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'ulid',
        'account_id',
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
        return AccountLedgerFactory::new();
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
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
