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
        Schema::create('income_deductions', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid')->index()->unique();
            $table->unsignedBigInteger('income_id')->index();
            $table->foreign('income_id')->references('id')->on('incomes')->onDelete('cascade');
            $table->string('name');
            $table->integer('amount');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->unsignedBigInteger('previous_id')->nullable();
            $table->string('change_reason')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('income_deductions');
    }
};
