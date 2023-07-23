<?php

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

uses(
    TestCase::class,
    LazilyRefreshDatabase::class,
)->in('Auth');

uses(
    TestCase::class,
    LazilyRefreshDatabase::class,
)->in('Feature');

uses(
    TestCase::class,
    LazilyRefreshDatabase::class,
)->in('Models');

uses(
    TestCase::class,
    LazilyRefreshDatabase::class,
)->in('Unit');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/
