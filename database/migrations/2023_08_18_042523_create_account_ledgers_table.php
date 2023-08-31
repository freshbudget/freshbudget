s<?php

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
        Schema::create('account_ledgers', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid')->index();
            $table->unsignedBigInteger('account_id')->index();
            $table->unsignedBigInteger('gross_amount')->default(0);
            $table->unsignedBigInteger('net_amount')->default(0);
            $table->unsignedBigInteger('total_entitlements')->default(0)->nullable();
            $table->unsignedBigInteger('total_taxes')->default(0)->nullable();
            $table->unsignedBigInteger('total_deductions')->default(0)->nullable();
            $table->json('entitlements')->nullable();
            $table->json('taxes')->nullable();
            $table->json('deductions')->nullable();
            $table->json('meta')->nullable();
            $table->timestamp('date')->nullable();
            $table->timestamps();

            // Foreign Keys
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_ledgers');
    }
};
