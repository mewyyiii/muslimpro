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
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('order_id')->unique();   // INV-{userId}-{timestamp}
            $table->unsignedInteger('amount');      // dalam rupiah
            $table->enum('status', [
                'pending',
                'success',
                'failed',
                'expired',
            ])->default('pending');
            $table->string('snap_token')->nullable(); // token dari Midtrans
            $table->timestamp('paid_at')->nullable(); // waktu bayar berhasil
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};