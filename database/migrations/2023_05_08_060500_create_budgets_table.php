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
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->string('ulid')->unique()->index();
            $table->string('name');
            $table->string('currency')->nullable()->default('USD');
            $table->unsignedBigInteger('owner_id')->index();
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('personal')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budgets');
    }
};
