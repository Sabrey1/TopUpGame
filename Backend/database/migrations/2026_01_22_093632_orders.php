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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code');
            $table->foreignId('game_id')->constrained('games')->onDelete('cascade');
            $table->foreignId('package_id')->constrained('topup_packages')->onDelete('cascade');  // ✅ match table name
            $table->integer('player_id');
            $table->integer('server_id');
            $table->decimal('price');
            $table->foreignId('payment_type_id')->constrained('payment_type')->onDelete('cascade');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
