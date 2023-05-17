<?php

namespace App\Domains\Users\Exceptions;

class InvitationFailedToSend extends \Exception
{
    public static function create()
    {
        return new static('The invitation failed to send.');
    }
}
