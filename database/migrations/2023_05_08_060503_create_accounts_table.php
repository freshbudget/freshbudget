<?php

use App\Domains\Shared\Enums\Currency;
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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid')->index();
            $table->unsignedBigInteger('budget_id')->index();
            $table->unsignedBigInteger('user_id')->index()->nullable();
            $table->string('name')->index();
            $table->text('description')->nullable();
            $table->string('type')->index()->nullable(); // AccountType::class
            $table->string('subtype')->index()->nullable(); // Dependent on type
            $table->string('currency')->index()->nullable()->default(Currency::USD->value);
            $table->string('frequency')->index()->nullable(); // Frequency::class
            $table->unsignedBigInteger('institution_id')->nullable();
            $table->text('url')->nullable();
            $table->string('username')->nullable();
            $table->string('color')->nullable();
            $table->json('meta')->nullable();
            $table->boolean('active')->default(true);
            $table->softDeletes();
            $table->timestamps();

            // Foreign Keys
            $table->foreign('budget_id')->references('id')->on('budgets')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('institution_id')->references('id')->on('institutes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
