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
        Schema::create('income_taxes', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid')->index()->unique();
            $table->unsignedBigInteger('account_id')->index();
            $table->string('name');
            $table->integer('amount');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->unsignedBigInteger('previous_id')->nullable();
            $table->string('change_reason')->nullable();
            $table->boolean('active')->default(true);
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
        Schema::dropIfExists('income_taxes');
    }
};