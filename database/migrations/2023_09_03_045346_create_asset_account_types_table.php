<?php

use App\Models\AssetAccountType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asset_account_types', function (Blueprint $table) {
            $table->id();
            $table->string('ulid')->unique()->index();
            $table->string('name');
            $table->string('abbr');
            $table->string('tagline')->nullable();
            $table->text('description')->nullable();
            $table->enum('type', ['current', 'long'])->default('current');
            $table->unsignedBigInteger('budget_id')->nullable()->index();
            $table->boolean('include_in_net_worth')->default(true);
            $table->timestamps();

            // Foreign Keys
            $table->foreign('budget_id')->references('id')->on('budgets')->onDelete('cascade');
        });

        $this->seedInitialData();
    }

    private function seedInitialData(): void
    {
        $types = [
            [
                'name' => 'Cash',
                'abbr' => 'CASH',
                'tagline' => 'Cash Account',
                'description' => 'An account that holds cash.',
                'type' => 'current',
            ],
            [
                'name' => 'Checking',
                'abbr' => 'CHK',
                'tagline' => 'Checking Account',
                'description' => 'An checking account that holds cash.',
                'type' => 'current',
            ],
            [
                'name' => 'Savings',
                'abbr' => 'SAV',
                'tagline' => 'Savings Account',
                'description' => 'An savings account that holds cash.',
                'type' => 'current',
            ],
            [
                'name' => 'Certificate of Deposit',
                'abbr' => 'CD',
                'tagline' => 'Certificate of Deposit',
                'description' => 'An certificate of deposit that holds cash.',
                'type' => 'long',
            ],
            [
                'name' => 'Money Market Account',
                'abbr' => 'MMA',
                'tagline' => 'Money Market Account',
                'description' => 'An money market account that holds cash.',
                'type' => 'current',
            ],
        ];

        foreach ($types as $type) {
            AssetAccountType::create($type);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('asset_account_types');
    }
};
