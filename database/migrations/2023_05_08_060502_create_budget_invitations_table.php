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
        Schema::create('budget_invitations', function (Blueprint $table) {
            $table->id();
            $table->string('ulid');
            $table->string('token');
            $table->string('name');
            $table->string('nickname')->nullable();
            $table->string('email')->nullable();
            $table->timestamp('expires_at');
            $table->string('state');
            $table->unsignedBigInteger('budget_id')->nullable();
            $table->foreign('budget_id')->references('id')->on('budgets')->onDelete('cascade');
            $table->unsignedBigInteger('invited_by_id')->nullable();
            $table->foreign('invited_by_id')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budget_invitations');
    }
};
