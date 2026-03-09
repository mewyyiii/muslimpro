<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('title');                    // nama iklan (untuk admin)
            $table->string('image');                    // path gambar
            $table->string('url')->nullable();          // link tujuan klik (opsional)
            $table->enum('position', [
                'in_content',
                'footer_sticky',
            ])->default('in_content');
            $table->json('pages');                      // ['all'] atau ['quran', 'tasbih', dst]
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};