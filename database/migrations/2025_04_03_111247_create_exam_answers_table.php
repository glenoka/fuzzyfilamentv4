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
        Schema::create('exam_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')->constrained('exams')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('question_id')->constrained('questions')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('option_id')->nullable();
            $table->string('essay_answer')->nullable();
            $table->integer('score')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam__answers');
    }
};
