<?php

// $name = 'name';

// $cb = (function () use ($name) {
//     echo $name;
// });

// $cb();

$a = new class
{
    protected string $name = 'name';

    public function __construct()
    {
        //
    }
};

echo $a->email;
