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
        Schema::table('lombas', function (Blueprint $table) {
            $table->string('tingkat')->nullable()->after('kategori'); // e.g. Nasional, Internasional
            $table->date('deadline')->nullable()->after('tingkat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lombas', function (Blueprint $table) {
            $table->dropColumn(['tingkat', 'deadline']);
        });
    }
};
