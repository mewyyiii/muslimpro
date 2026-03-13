<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('doa_pendek', function (Blueprint $table) {
            $table->string('audio_url')->nullable()->after('translation');
        });
    }

    public function down(): void
    {
        Schema::table('doa_pendek', function (Blueprint $table) {
            $table->dropColumn('audio_url');
        });
    }
};