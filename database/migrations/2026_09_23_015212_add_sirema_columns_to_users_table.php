<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->year('angkatan')->nullable()->after('role');
            $table->integer('semester_aktif')->nullable()->after('angkatan');
            $table->string('google_id')->nullable()->after('email');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['angkatan', 'semester_aktif', 'google_id']);
        });
    }
};
