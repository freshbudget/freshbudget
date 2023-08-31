<?php

namespace App\Domains\Accounts\Models;

use Database\Factories\AccountLedgerFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountLedger extends Model
{
    use HasFactory, HasUlids;

    /*
    |----------------------------------
    | Model Configuration
    |----------------------------------
    */
    public static function newFactory()
    {
        return AccountLedgerFactory::new();
    }

    /*
    |----------------------------------
    | Relationships
    |----------------------------------
    */
}
