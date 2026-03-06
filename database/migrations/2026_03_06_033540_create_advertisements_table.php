<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->string('title');                        // nama iklan (untuk admin)
            $table->string('image_path')->nullable();       // path gambar banner
            $table->string('url')->nullable();              // URL tujuan saat diklik
            $table->enum('position', [
                'footer_sticky',    // sticky di bawah layar
                'in_content',       // di antara konten
            ])->default('footer_sticky');
            $table->json('pages')->nullable();              // null = semua halaman, atau ['quran','shalat']
            $table->boolean('is_active')->default(true);
            $table->timestamp('starts_at')->nullable();     // null = langsung aktif
            $table->timestamp('ends_at')->nullable();       // null = tidak ada expiry
            $table->unsignedInteger('click_count')->default(0);
            $table->unsignedInteger('impression_count')->default(0);
            $table->timestamps();

            $table->index(['is_active', 'position']);
        });

        Schema::create('pro_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('order_id')->unique();           // order id ke Midtrans
            $table->string('midtrans_transaction_id')->nullable();
            $table->enum('status', [
                'pending',
                'paid',
                'expired',
                'cancelled',
                'refunded',
            ])->default('pending');
            $table->enum('plan', ['monthly', 'yearly'])->default('monthly');
            $table->unsignedInteger('amount');              // nominal dalam rupiah
            $table->string('payment_method')->nullable();  // gopay, bca, qris, dll
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->json('midtrans_payload')->nullable();   // simpan raw response Midtrans
            $table->timestamps();

            $table->index(['user_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pro_subscriptions');
        Schema::dropIfExists('advertisements');
    }
};