<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssessmentTool extends Model
{
    protected $table = 'assessment_tools';
    protected $primaryKey = 'id_at';

    protected $fillable = [
        'id_clo',
        'nama_at',
        'weight_in_clo',
    ];

    public function clo()
    {
        return $this->belongsTo(Clo::class, 'id_clo', 'id_clo');
    }

    public function nilaiMahasiswa()
    {
        return $this->hasMany(NilaiMahasiswa::class, 'id_at', 'id_at');
    }
}
