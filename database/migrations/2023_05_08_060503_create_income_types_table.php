<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Domains\Incomes\Models\IncomeType;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('income_types', function (Blueprint $table) {
            $table->id();
            $table->string('ulid');
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
            ]
        ];

        foreach ($types as $type) {
            IncomeType::create($type);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('income_types');
    }
};
