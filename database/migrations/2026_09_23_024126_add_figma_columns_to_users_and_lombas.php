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
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('gpa', 3, 2)->nullable(); // e.g. 3.85
            $table->string('pbl_status')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('github')->nullable();
            $table->text('skills')->nullable();
        });

        Schema::table('lombas', function (Blueprint $table) {
            $table->string('cover_image')->nullable();
            $table->string('kategori')->nullable(); // e.g. Akademik, Non-Akademik
            $table->integer('peserta_maks')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['gpa', 'pbl_status', 'linkedin', 'github', 'skills']);
        });

        Schema::table('lombas', function (Blueprint $table) {
            $table->dropColumn(['cover_image', 'kategori', 'peserta_maks']);
        });
    }
};
