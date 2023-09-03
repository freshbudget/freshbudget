<?php

namespace App\Exceptions;

class CannotAcceptInvitationBudgetDeleted extends \Exception
{
    public static function create()
    {
        return new static('You cannot accept this invitation because the budget no longer exists.');
    }
}
