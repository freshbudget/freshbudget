<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid')->index();
            $table->unsignedBigInteger('ledger_id')->index();
            $table->morphs('from_account');
            $table->morphs('to_account');
            $table->string('type')->nullable(); // Debit, Credit, Transfer
            $table->unsignedBigInteger('amount'); // in cents
            $table->string('currency')->default('USD');
            $table->string('title')->nullable()->index();
            $table->text('description')->nullable();
            $table->timestamp('date')->nullable();
            $table->timestamps();

            // Foreign Keys
            $table->foreign('ledger_id')->references('id')->on('budget_ledgers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};