<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asesmen_questions', function (Blueprint $table) {
            $table->id();
            $table->integer('semester');
            $table->text('question_text');
            $table->enum('question_type', ['pilihan_ganda', 'skala', 'teks'])->default('pilihan_ganda');
            $table->json('options')->nullable(); // For pilihan_ganda options
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asesmen_questions');
    }
};
