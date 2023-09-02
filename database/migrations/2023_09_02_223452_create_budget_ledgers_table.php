<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('budget_ledgers', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid')->unique()->index();
            $table->unsignedBigInteger('budget_id')->index();
            $table->timestamps();

            // Foreign keys
            $table->foreign('budget_id')->references('id')->on('budgets')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('budget_ledgers');
    }
};
