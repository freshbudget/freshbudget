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
        Schema::create('income_entitlements', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid')->index()->unique();
            $table->unsignedBigInteger('income_id')->index();
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('amount');
            $table->date('start_date');
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
        Schema::dropIfExists('income_entitlements');
    }
};
