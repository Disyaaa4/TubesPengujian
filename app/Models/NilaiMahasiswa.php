<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiMahasiswa extends Model
{
    protected $table = 'nilai_mahasiswa';
    protected $primaryKey = 'id_nilai';

    protected $fillable = [
        'id_mahasiswa',
        'id_at',
        'score',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id_mahasiswa');
    }

    public function assessmentTool()
    {
        return $this->belongsTo(AssessmentTool::class, 'id_at', 'id_at');
    }
}
