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
        Schema::create('data_clo', function (Blueprint $table) {
            $table->id('id_clo');
            $table->foreignId('id_mk')
                ->nullable()
                ->constrained('mata_kuliah', 'id_mk')
                ->cascadeOnDelete();

            $table->string('nama_clo', 10);
            $table->text('description_clo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_clo');
    }
};
