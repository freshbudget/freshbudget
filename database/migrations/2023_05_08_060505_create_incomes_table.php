<?php

use App\Domains\Shared\Enums\Frequency;
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
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->string('ulid')->unique()->index();
            $table->unsignedBigInteger('budget_id');
            $table->foreign('budget_id')->references('id')->on('budgets')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('type_id')->nullable();
            $table->foreign('type_id')->references('id')->on('income_types')->onDelete('set null');
            $table->text('url')->nullable();
            $table->string('username')->nullable();
            $table->string('currency')->nullable()->default('USD');
            $table->string('frequency')->nullable()->default(Frequency::MONTHLY->value);
            $table->json('meta')->nullable();
            $table->boolean('active')->default(true);
            $table->integer('estimated_entitlements_per_period')->nullable()->default(0);
            $table->integer('estimated_taxes_per_period')->nullable()->default(0);
            $table->integer('estimated_deductions_per_period')->nullable()->default(0);
            $table->integer('estimated_net_per_period')->nullable()->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incomes');
    }
};
