<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('account_entitlements', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid')->index();
            $table->morphs('account'); // account_id, account_type
            $table->string('name')->index();
            $table->text('description')->nullable();
            $table->integer('amount')->default(0); 
            // I somehow need to make this field versionable, to track change in entitlement over time...
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();

            // Foreign Keys
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('account_entitlements');
    }
};
