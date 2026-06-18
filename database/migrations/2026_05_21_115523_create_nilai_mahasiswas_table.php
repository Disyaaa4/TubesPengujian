<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nilai_mahasiswa', function (Blueprint $table) {
            $table->id('id_nilai');

            $table->foreignId('id_mahasiswa')
                ->nullable()
                ->constrained('mahasiswa', 'id_mahasiswa')
                ->cascadeOnDelete();

            $table->foreignId('id_at')
                ->nullable()
                ->constrained('assessment_tools', 'id_at')
                ->cascadeOnDelete();

            $table->decimal('score', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_mahasiswa');
    }
};
