<?php

use App\Domains\Incomes\Models\IncomeFrequency;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('income_frequencies', function (Blueprint $table) {
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
                'name' => 'One Time',
                'abbr' => 'OT',
                'tagline' => 'One Time Income',
                'description' => 'An income that occurs only once.',
            ],
            [
                'name' => 'Weekly',
                'abbr' => 'Weekly',
                'tagline' => 'Weekly Income',
                'description' => 'An income that occurs every week.',
            ],
            [
                'name' => 'Bi-Weekly',
                'abbr' => 'Bi-Weekly',
                'tagline' => 'Bi-Weekly Income',
                'description' => 'An income that occurs every two weeks.',
            ],
            [
                'name' => 'Monthly',
                'abbr' => 'Monthly',
                'tagline' => 'Monthly Income',
                'description' => 'An income that occurs every month.',
            ],
            [
                'name' => 'Irregular',
                'abbr' => 'Irregular',
                'tagline' => 'Irregular Income',
                'description' => 'An income that occurs irregularly.',
            ],
        ];

        foreach ($types as $type) {
            IncomeFrequency::create($type);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('income_frequencies');
    }
};
