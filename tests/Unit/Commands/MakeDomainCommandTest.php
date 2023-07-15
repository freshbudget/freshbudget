<?php

// before each test, delete the domain if it exists
beforeEach(function () {
    $path = app_path('Domains'.DIRECTORY_SEPARATOR.'TestDomainForTesting');

    if (is_dir($path)) {
        rmdir($path);
    }
});

// after each test, delete the domain if it exists
afterEach(function () {
    $path = app_path('Domains'.DIRECTORY_SEPARATOR.'TestDomainForTesting');

    if (is_dir($path)) {
        rmdir($path);
    }
});

test('the command will not run in production', function () {
    // set the environment to production
    app()->environment('production');

    // run the command
    $this->artisan('make:domain', ['domain' => 'Test'])
        ->expectsOutput('The environment is not local, aborting.');

    // assert the domain was not created
    $path = app_path('Domains'.DIRECTORY_SEPARATOR.'TestDomainForTesting');

    $this->assertFalse(is_dir($path));
});