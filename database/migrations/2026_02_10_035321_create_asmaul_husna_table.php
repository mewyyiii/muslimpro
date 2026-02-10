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
        Schema::create('asmaul_husna', function (Blueprint $table) {
            $table->id();
            $table->string('arabic');
            $table->string('transliteration');
            $table->text('meaning_id');
            $table->text('meaning_en');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asmaul_husna');
    }
};
