<?php

namespace App\Domains\Users\Exceptions;

class CannotAcceptExpiredInvitation extends \Exception
{
    public static function create()
    {
        return new static('You cannot accept an expired invitation.');
    }
}
