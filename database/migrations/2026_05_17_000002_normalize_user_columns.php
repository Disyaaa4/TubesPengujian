<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('users')) {
            // Rename primary key column from id to id_user when needed.
            if (Schema::hasColumn('users', 'id') && ! Schema::hasColumn('users', 'id_user')) {
                DB::statement('ALTER TABLE `users` CHANGE COLUMN `id` `id_user` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT;');
            }

            Schema::table('users', function (Blueprint $table) {
                if (! Schema::hasColumn('users', 'username')) {
                    $table->string('username')->unique()->nullable()->after('id_user');
                }
                if (! Schema::hasColumn('users', 'nama_lengkap')) {
                    $table->string('nama_lengkap')->nullable()->after('username');
                }
                if (! Schema::hasColumn('users', 'nip')) {
                    $table->string('nip')->nullable()->after('nama_lengkap');
                }
                if (! Schema::hasColumn('users', 'nidn')) {
                    $table->string('nidn')->nullable()->after('nip');
                }
                if (! Schema::hasColumn('users', 'kode_dosen')) {
                    $table->string('kode_dosen')->nullable()->after('nidn');
                }
                if (! Schema::hasColumn('users', 'role')) {
                    $table->string('role')->default('dosen wali')->after('kode_dosen');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                if (Schema::hasColumn('users', 'role')) {
                    $table->dropColumn('role');
                }
                if (Schema::hasColumn('users', 'kode_dosen')) {
                    $table->dropColumn('kode_dosen');
                }
                if (Schema::hasColumn('users', 'nidn')) {
                    $table->dropColumn('nidn');
                }
                if (Schema::hasColumn('users', 'nip')) {
                    $table->dropColumn('nip');
                }
                if (Schema::hasColumn('users', 'nama_lengkap')) {
                    $table->dropColumn('nama_lengkap');
                }
                if (Schema::hasColumn('users', 'username')) {
                    $table->dropUnique(['username']);
                    $table->dropColumn('username');
                }
            });

            if (Schema::hasColumn('users', 'id_user') && ! Schema::hasColumn('users', 'id')) {
                DB::statement('ALTER TABLE `users` CHANGE COLUMN `id_user` `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT;');
            }
        }
    }
};
