<?php

$name = 'name';

$cb = (function () use ($name) {
    echo $name;
});

$cb();
