<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id('id_mahasiswa');
            $table->string('nim', 20)->unique();
            $table->string('nama', 100);
            $table->year('tahun_masuk');
            $table->string('class_code', 20)->nullable();
            $table->enum('status', ['Aktif', 'Cuti', 'Lulus', 'DO'])->default('Aktif');

            // Harus sama dengan users.kode_dosen
            $table->char('kode_dosen', 3)->nullable()->index();

            $table->timestamps();

            $table->foreign('kode_dosen')
                ->references('kode_dosen')
                ->on('users')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->dropForeign(['kode_dosen']);
        });

        Schema::dropIfExists('mahasiswa');
    }
};
