<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * App\Models\Transaction
 *
 * @property int $id
 * @property string $ulid
 * @property int $ledger_id
 * @property int $from_account_id
 * @property int $to_account_id
 * @property string|null $type
 * @property int $amount
 * @property string $currency
 * @property string|null $title
 * @property string|null $description
 * @property string|null $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read BudgetLedger $ledger
 *
 * @method static \Database\Factories\TransactionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereFromAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereLedgerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereToAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUpdatedAt($value)
 *
 * @property string $transactionable_type
 * @property int $transactionable_id
 * @property-read \App\Models\Account $fromAccount
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTransactionableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTransactionableType($value)
 *
 * @property string $from_account_type
 * @property string $to_account_type
 * @property-read Model|\Eloquent $toAccount
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereFromAccountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereToAccountType($value)
 *
 * @mixin \Eloquent
 */
class Transaction extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'ulid',
        'ledger_id',
        'from_account_type',
        'from_account_id',
        'to_account_type',
        'to_account_id',
        'type',
        'amount',
        'currency',
        'title',
        'description',
        'date',
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

    public function uniqueIds(): array
    {
        return ['ulid'];
    }

    /*
    |----------------------------------
    | Relationships
    |----------------------------------
    */
    public function budget(): Budget
    {
        return $this->ledger->budget;
    }

    public function ledger(): BelongsTo
    {
        return $this->belongsTo(BudgetLedger::class, 'ledger_id');
    }

    public function fromAccount(): MorphTo
    {
        return $this->morphTo('from_account');
    }

    public function toAccount(): MorphTo
    {
        return $this->morphTo('to_account');
    }
}
