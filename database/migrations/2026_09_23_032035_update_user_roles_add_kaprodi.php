<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Alter the enum to include 'koordinator' and 'kaprodi'
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('mahasiswa', 'staf', 'koor_kaprodi', 'koordinator', 'kaprodi') NOT NULL DEFAULT 'mahasiswa'");
        
        // Update existing 'koor_kaprodi' to 'koordinator'
        DB::table('users')->where('role', 'koor_kaprodi')->update(['role' => 'koordinator']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert 'koordinator' and 'kaprodi' back to 'koor_kaprodi'
        DB::table('users')->whereIn('role', ['koordinator', 'kaprodi'])->update(['role' => 'koor_kaprodi']);
        
        // Alter the enum back
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('mahasiswa', 'staf', 'koor_kaprodi') NOT NULL DEFAULT 'mahasiswa'");
    }
};
