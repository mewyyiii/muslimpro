<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_pro')->default(false)->after('email');
            $table->timestamp('pro_expires_at')->nullable()->after('is_pro');
            $table->string('pro_activated_by')->nullable()->after('pro_expires_at');
            $table->boolean('is_admin')->default(false)->after('pro_activated_by');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'is_pro',
                'pro_expires_at',
                'pro_activated_by',
                'is_admin'
            ]);
        });
    }
};