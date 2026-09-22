<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_assessed')->default(false);
            $table->integer('skor_minat_bakat')->nullable();
            $table->integer('skor_matkul')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['is_assessed', 'skor_minat_bakat', 'skor_matkul']);
        });
    }
};
