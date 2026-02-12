<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quran_trackings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('surah_number'); // 1-114
            $table->integer('last_verse')->nullable(); // ayat terakhir yang dibaca
            $table->boolean('is_completed')->default(false); // surah selesai atau belum
            $table->integer('duration_seconds')->default(0); // total durasi baca (detik)
            $table->date('last_read_date')->nullable(); // tanggal terakhir baca
            $table->timestamps();

            // User hanya punya 1 tracking per surah
            $table->unique(['user_id', 'surah_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quran_trackings');
    }
};