<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeDomainCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:domain {domain?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new domain directory structure';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (! app()->isLocal()) {
            $this->error('This command can only be run in local environment!');

            return;
        }

        // check if the user passed a domain name as an argument
        $domain = $this->argument('domain');

        if (! $domain) {
            $domain = $this->ask('Domain name?'); // e.g. User
        }

        // ensure the domain is not empty
        if (! $domain) {
            $this->error('Domain name cannot be empty!');

            return;
        }

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
            'Notifications',
            'Policies',
            'Jobs',
            'Support',
        ];

        foreach ($directories as $directory) {
            File::ensureDirectoryExists($path.DIRECTORY_SEPARATOR.$directory);
        }

        $this->info('Domain created successfully!');
    }
}
