<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('institutes', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid')->index();
            $table->string('name')->index();
            $table->string('abbr')->unique()->index()->nullable();
            $table->string('color')->nullable();
            $table->text('logo')->nullable();
            $table->text('description')->nullable();
            $table->text('general_url')->nullable();
            $table->text('auth_url')->nullable();
            $table->boolean('active')->default(true)->index();
            $table->unsignedBigInteger('budget_id')->nullable()->index();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->timestamps();

            $table->foreign('budget_id')->references('id')->on('budgets')->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });

        $this->seedInitialInstitutes();
    }

    protected function seedInitialInstitutes(): void
    {
        $data = [
            [
                'name' => 'Bank of America',
                'abbr' => 'BOA',
                'color' => '#004481', // blue
                'description' => 'Bank of America Corporation is an American multinational investment bank and financial services holding company headquartered in Charlotte, North Carolina.',
                'general_url' => 'https://www.bankofamerica.com/',
                'auth_url' => 'https://www.bankofamerica.com/',
            ],
            [
                'name' => 'Chase',
                'abbr' => 'Chase',
                'color' => '#0f3a63', // blue
                'description' => 'JPMorgan Chase & Co. is an American multinational investment bank and financial services holding company headquartered in New York City.',
                'general_url' => 'https://www.chase.com/',
                'auth_url' => 'https://www.chase.com/',
            ],
            [
                'name' => 'Wells Fargo',
                'abbr' => 'WF',
                'color' => '#ce0000', // red
                'description' => 'Wells Fargo & Company is an American multinational financial services company with corporate headquarters in San Francisco, California, operational headquarters in Manhattan, and managerial offices throughout the United States and overseas.',
                'general_url' => 'https://www.wellsfargo.com/',
                'auth_url' => 'https://www.wellsfargo.com/',
            ],
            [
                'name' => 'Citibank',
                'abbr' => 'Citi',
                'color' => '#0064a5', // blue
                'description' => 'Citibank is the consumer division of financial services multinational Citigroup.',
                'general_url' => 'https://www.citi.com/',
                'auth_url' => 'https://www.citi.com/',
            ],
            [
                'name' => 'USAA',
                'abbr' => 'USAA',
                'color' => '#003a63', // blue
                'description' => '',
                'general_url' => 'https://www.usaa.com/',
                'auth_url' => 'https://www.usaa.com/',
            ],
            [
                'name' => 'Navy Federal Credit Union',
                'abbr' => 'NFCU',
                'color' => '#0d4c92', // blue
                'description' => '',
                'general_url' => 'https://www.navyfederal.org/',
                'auth_url' => 'https://www.navyfederal.org/',
            ],
            [
                'name' => 'Capital One',
                'abbr' => 'CO',
                'color' => '#004481', // blue
                'description' => '',
                'general_url' => 'https://www.capitalone.com/',
                'auth_url' => 'https://www.capitalone.com/',
            ],
            [
                'name' => 'Ally',
                'abbr' => 'Ally',
                'color' => '#e4002b', // red
                'description' => '',
                'general_url' => 'https://www.ally.com/',
                'auth_url' => 'https://www.ally.com/',
            ],
            [
                'name' => 'Discover',
                'abbr' => 'Discover',
                'color' => '#ff6000', // orange
                'description' => '',
                'general_url' => 'https://www.discover.com/',
                'auth_url' => 'https://www.discover.com/',
            ],
            [
                'name' => 'American Express',
                'abbr' => 'Amex',
                'color' => '#0078d2', // blue
                'description' => '',
                'general_url' => 'https://www.americanexpress.com/',
                'auth_url' => 'https://www.americanexpress.com/',
            ],
            [
                'name' => 'US Bank',
                'abbr' => 'US Bank',
                'color' => '#0d4c92', // blue
                'description' => '',
                'general_url' => 'https://www.usbank.com/',
                'auth_url' => 'https://www.usbank.com/',
            ],
            [
                'name' => 'Not Applicable',
                'abbr' => 'N/A',
                'color' => '#0d4c92', // blue
                'description' => null,
                'general_url' => null,
                'auth_url' => null,
            ],
            [
                'name' => 'Sandia Area Federal Credit Union',
                'abbr' => 'Sandia Area',
                'color' => '#0d4c92', // blue
                'description' => null,
                'general_url' => 'https://www.sandia.org/',
                'auth_url' => 'https://www.sandia.org/',
            ],
        ];

        foreach ($data as $institute) {
            DB::table('institutes')->insert([
                'ulid' => Str::ulid(),
                'name' => $institute['name'],
                'abbr' => $institute['abbr'],
                'color' => $institute['color'],
                'description' => $institute['description'],
                'general_url' => $institute['general_url'],
                'auth_url' => $institute['auth_url'],
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('institutes');
    }
};
