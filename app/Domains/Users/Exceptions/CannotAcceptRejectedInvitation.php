<?php

namespace App\Domains\Users\Exceptions;

class CannotAcceptRejectedInvitation extends \Exception
{
    public static function create()
    {
        return new static('You cannot accept a rejected invitation.');
    }
}
