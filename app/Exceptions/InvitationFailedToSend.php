<?php

namespace App\Exceptions;

class InvitationFailedToSend extends \Exception
{
    public static function create()
    {
        return new static('The invitation failed to send.');
    }
}
