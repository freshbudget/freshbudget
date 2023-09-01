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
        Schema::create('budget_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('budget_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('role')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('budget_id')->references('id')->on('budgets')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budget_users');
    }
};
