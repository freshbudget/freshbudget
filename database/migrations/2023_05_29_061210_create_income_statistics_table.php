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
        Schema::create('income_statistics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('income_id')->index();
            $table->foreign('income_id')->references('id')->on('incomes')->onDelete('cascade');
            $table->string('name')->index()->nullable();
            $table->string('type')->index()->nullable();
            $table->bigInteger('value')->index()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('income_statistics');
    }
};
