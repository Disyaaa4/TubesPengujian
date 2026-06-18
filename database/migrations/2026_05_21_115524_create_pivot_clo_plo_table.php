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
        Schema::create('pivot_clo_plo', function (Blueprint $table) {
            $table->id('id_pivot');

            $table->foreignId('id_clo')
                ->constrained('data_clo', 'id_clo')
                ->cascadeOnDelete();

            $table->foreignId('id_plo')
                ->constrained('data_plo', 'id_plo')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_clo_plo');
    }
};
