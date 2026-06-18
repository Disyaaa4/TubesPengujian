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
        Schema::create('assessment_tools', function (Blueprint $table) {
            $table->id('id_at');
            $table->foreignId('id_clo')
                ->nullable()
                ->constrained('data_clo', 'id_clo')
                ->cascadeOnDelete();

            $table->string('nama_at', 100);
            $table->decimal('weight_in_clo', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_tools');
    }
};
