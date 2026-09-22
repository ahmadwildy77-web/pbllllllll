<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asesmen_statistiks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('lomba_id')->constrained('lombas')->onDelete('cascade');
            $table->decimal('nilai', 5, 2)->nullable();
            $table->enum('status_keputusan', ['pending', 'terpilih', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asesmen_statistiks');
    }
};
