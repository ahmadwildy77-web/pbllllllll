<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asesmen_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('question_id')->constrained('asesmen_questions')->cascadeOnDelete();
            $table->text('response_value');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asesmen_responses');
    }
};
