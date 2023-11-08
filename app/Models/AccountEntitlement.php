<?php

namespace App\Models;

use App\Models\Account;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\AccountEntitlementFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class AccountEntitlement extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'ulid',
        'account_id',
        'account_type',
        'name',
        'description',
        'amount',
        'start_date',
        'end_date',
        'active',
    ];

    protected $casts = [
        'id' => 'integer',
        'account_id' => 'integer',
        'start_date' => 'date',
        'end_date' => 'date',
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

    public function uniqueIds(): array
    {
        return ['ulid'];
    }
    
    /*
    |----------------------------------
    | Relationships
    |----------------------------------
    */
    public function account(): MorphTo
    {
        return $this->morphTo(Account::class);
    }
}
