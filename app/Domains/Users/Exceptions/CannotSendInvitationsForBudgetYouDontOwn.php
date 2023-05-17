<?php

namespace App\Domains\Users\Exceptions;

class CannotSendInvitationsForBudgetYouDontOwn extends \Exception
{
    public static function create()
    {
        return new static('You cannot send invitations for a budget you don\'t own.');
    }
}
