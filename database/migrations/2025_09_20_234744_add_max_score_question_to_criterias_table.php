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
        Schema::table('criterias', function (Blueprint $table) {
            // Menambahkan kolom integer baru bernama 'max_score_question' setelah kolom 'value'
            //untuk tau nilai max per soal
            $table->integer('max_score_question')->after('value')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
   public function down(): void
    {
        Schema::table('criterias', function (Blueprint $table) {
            // Menghapus kolom jika migrasi di-rollback
            $table->dropColumn('max_score_question');
        });
    }
};
