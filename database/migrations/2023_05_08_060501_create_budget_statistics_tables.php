<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('budget_statistics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('budget_id')->references('id')->on('budgets')->onDelete('cascade');
            $table->string('model_type')->index();
            $table->unsignedBigInteger('model_id')->index();
            $table->string('type')->index()->nullable();
            $table->bigInteger('value')->index()->nullable();
            $table->string('name')->index()->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('budget_statistics');
    }
};
