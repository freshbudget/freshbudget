<?php

namespace App\Events\Budgets;

use App\Models\BudgetInvitation;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BudgetInvitationAccepted
{
    use Dispatchable, SerializesModels;

    public function __construct(public BudgetInvitation $invitation)
    {
        //
    }
}
