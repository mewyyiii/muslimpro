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
        Schema::create('verses', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('surah_number');
            $table->unsignedSmallInteger('number');
            $table->text('arabic');
            $table->text('translation');
            $table->text('transliteration');
            $table->timestamps();

            $table->foreign('surah_number')->references('number')->on('surahs')->onDelete('cascade');
            $table->unique(['surah_number', 'number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verses');
    }
};
