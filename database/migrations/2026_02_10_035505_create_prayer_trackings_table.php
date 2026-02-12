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
        Schema::create('prayer_trackings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('prayer_name'); // e.g., 'fajr', 'dhuhr', 'asr', 'maghrib', 'isha'
            $table->date('prayer_date');
            $table->string('status'); // e.g., 'performed', 'missed', 'qada'
            $table->timestamps();

            $table->unique(['user_id', 'prayer_date', 'prayer_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prayer_trackings');
    }
};
