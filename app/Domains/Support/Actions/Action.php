<?php

namespace App\Domains\Support\Actions;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Action
{
    use AuthorizesRequests, ValidatesRequests;
}
