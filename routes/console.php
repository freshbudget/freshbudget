<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

Artisan::command('make:domain', function () {

    // only run this command in local environment
    if (! app()->isLocal()) {
        $this->error('This command can only be run in local environment!');

        return;
    }

    $domain = $this->ask('Domain name?'); // e.g. User

    $domain = str($domain)->studly(); // e.g. Users

    $path = app_path('Domains'.DIRECTORY_SEPARATOR.$domain);

    if (is_dir($path)) {
        $this->error('Domain already exists!');

        return;
    }

    File::ensureDirectoryExists($path);

    $directories = [
        'Actions',
        'Events',
        'Exceptions',
        'Models',
        'Policies',
        'Jobs',
        'Support',
    ];

    foreach ($directories as $directory) {
        File::ensureDirectoryExists($path.DIRECTORY_SEPARATOR.$directory);
    }

    $this->info('Domain created successfully!');
})->describe('Create a new domain directory structure');
