<?php

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
        Schema::create('income_entries', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid')->index()->unique();
            $table->unsignedBigInteger('income_id')->index();
            $table->foreign('income_id')->references('id')->on('incomes')->onDelete('cascade');
            $table->date('date');
            $table->json('entitlements');
            $table->json('taxes');
            $table->json('deductions');
            $table->integer('entitlements_total');
            $table->integer('taxes_total');
            $table->integer('deductions_total');
            $table->integer('net_income');
            $table->text('notes')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('income_entries');
    }
};
