<?php

namespace App\Exceptions;

class CannotAcceptInvitationNotSentToYou extends \Exception
{
    public static function create()
    {
        return new static('You cannot accept an invitation that was not sent to you.');
    }
}
