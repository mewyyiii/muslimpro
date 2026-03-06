<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('azan_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('azan_enabled')->default(true);
            $table->string('muadzin')->default('makkah'); // makkah | madinah | mesir
            $table->boolean('fajr_enabled')->default(true);
            $table->boolean('dhuhr_enabled')->default(true);
            $table->boolean('asr_enabled')->default(true);
            $table->boolean('maghrib_enabled')->default(true);
            $table->boolean('isha_enabled')->default(true);
            $table->timestamps();

            $table->unique('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('azan_settings');
    }
};