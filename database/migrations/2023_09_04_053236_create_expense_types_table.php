<?php

use App\Models\ExpenseType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('expense_types', function (Blueprint $table) {
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
                'name' => 'Recurring',
                'abbr' => 'RECURRING',
                'tagline' => 'Recurring expenses',
                'description' => 'Recurring expenses are those that occur regularly and are expected to continue into the future. Examples include rent, utilities, and salaries.',
            ],
            [
                'name' => 'One-time',
                'abbr' => 'ONE-TIME',
                'tagline' => 'One-time expenses',
                'description' => 'One-time expenses are those that occur infrequently and are not expected to continue into the future. Examples include the purchase of a new computer or the repair of a piece of equipment.',
            ],
            [
                'name' => 'Discretionary',
                'abbr' => 'DISCRETIONARY',
                'tagline' => 'Discretionary expenses',
                'description' => 'Discretionary expenses are those that are not necessary for the operation of the business. Examples include travel, entertainment, and charitable contributions.',
            ],
            [
                'name' => 'Fixed',
                'abbr' => 'FIXED',
                'tagline' => 'Fixed expenses',
                'description' => 'Fixed expenses are those that do not change from month to month, or that change only slightly. Examples include rent, insurance, and loan payments.',
            ],
            [
                'name' => 'Variable',
                'abbr' => 'VARIABLE',
                'tagline' => 'Variable expenses',
                'description' => 'Variable expenses are those that change from month to month. Examples include utilities, supplies, and repairs.',
            ],
            [
                'name' => 'Credit',
                'abbr' => 'CREDIT',
                'tagline' => 'Credit expenses',
                'description' => 'Credit expenses are those that are paid for using a credit card. Examples include travel, entertainment, and charitable contributions.',
            ],
            [
                'name' => 'Investment',
                'abbr' => 'INVESTMENT',
                'tagline' => 'Investment expenses',
                'description' => 'Investment expenses are those that are spent on investments. Examples include stocks, bonds, and real estate.',
            ],
        ];

        foreach ($types as $type) {
            ExpenseType::create($type);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('expense_types');
    }
};
