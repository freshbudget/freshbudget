<?php

namespace App\Domains\Accounts\Events;

use App\Domains\Accounts\Models\Account;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AccountDeleted
{
    use Dispatchable, SerializesModels;

    public function __construct(public Account $account)
    {
        //
    }
}
