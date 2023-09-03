<?php

namespace App\Exceptions;

class CannotAccessABudgetYouDontBelongTo extends \Exception
{
    public static function create()
    {
        return new static('You cannot access a budget that you are not a member of.');
    }
}
