<?php

namespace App\Domains\Budgets\Events;

use App\Domains\Budgets\Models\BudgetInvitation;
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
