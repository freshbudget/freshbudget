<?php

use App\Models\IncomeType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('income_types', function (Blueprint $table) {
            $table->id();
            $table->string('ulid')->unique()->index();
            $table->string('name');
            $table->string('abbr');
            $table->string('tagline')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        $this->seedInitialData();
    }

    private function seedInitialData(): void
    {
        $types = [
            [
                'name' => 'Salary',
                'abbr' => 'SAL',
                'tagline' => 'Salary Income',
                'description' => 'An income that is received as a salary.',
            ],
            [
                'name' => 'Tips',
                'abbr' => 'TIP',
                'tagline' => 'Tips Income',
                'description' => 'An income that is received as tips.',
            ],
            [
                'name' => 'Bonus',
                'abbr' => 'BON',
                'tagline' => 'Bonus Income',
                'description' => 'An income that is received as a bonus.',
            ],
            [
                'name' => 'Commission',
                'abbr' => 'COM',
                'tagline' => 'Commission Income',
                'description' => 'An income that is received as a commission.',
            ],
            [
                'name' => 'Dividend',
                'abbr' => 'DIV',
                'tagline' => 'Dividend Income',
                'description' => 'An income that is received as a dividend.',
            ],
            [
                'name' => 'Interest',
                'abbr' => 'INT',
                'tagline' => 'Interest Income',
                'description' => 'An income that is received as interest.',
            ],
            [
                'name' => 'Hourly',
                'abbr' => 'HRL',
                'tagline' => 'Hourly Income',
                'description' => 'An income that is received as hourly.',
            ],
            [
                'name' => 'Sales',
                'abbr' => 'SAL',
                'tagline' => 'Sales Income',
                'description' => 'An income that is received from the sales of goods or services.',
            ],
            [
                'name' => 'Rental',
                'abbr' => 'Rental',
                'tagline' => 'Rental Income',
                'description' => 'An income that is received from the payment of a rental fee.',
            ],
            [
                'name' => 'Dues',
                'abbr' => 'DUES',
                'tagline' => 'Dues Income',
                'description' => 'An income that is received as dues.',
            ],
            [
                'name' => 'Cash',
                'abbr' => 'CASH',
                'tagline' => 'Cash Income',
                'description' => 'An income that is received as cash.',
            ],
            [
                'name' => 'Royalty',
                'abbr' => 'ROY',
                'tagline' => 'Royalty Income',
                'description' => 'An income that is received as royalty.',
            ],
            [
                'name' => 'Other',
                'abbr' => 'OTH',
                'tagline' => 'Other Income',
                'description' => 'An income that is received as other.',
            ],
            [
                'name' => 'Unknown',
                'abbr' => 'UNK',
                'tagline' => 'Unknown Income',
                'description' => 'An income that is received from an unknown source.',
            ],
        ];

        foreach ($types as $type) {
            IncomeType::create($type);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('income_types');
    }
};
