<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id_mahasiswa';

    protected $fillable = [
        'nim',
        'nama',
        'tahun_masuk',
        'class_code',
        'status',
        'kode_dosen',
    ];

    public function dosenWali()
    {
        return $this->belongsTo(User::class, 'kode_dosen', 'kode_dosen');
    }

    public function nilaiMahasiswa()
    {
        return $this->hasMany(NilaiMahasiswa::class, 'id_mahasiswa', 'id_mahasiswa');
    }
}
