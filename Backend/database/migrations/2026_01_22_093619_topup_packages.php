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
        Schema::create('topup_packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('game_id');
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->integer('amount')->nullable();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->string('discount')->nullable();
            $table->decimal('price', 12, 2)->nullable();
            $table->decimal('fullprice', 12, 2)->nullable();
            $table->boolean('best_seller')->nullable();
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->timestamps();

            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topupPackages');
    }
};
