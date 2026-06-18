<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clo extends Model
{
    protected $table = 'data_clo';
    protected $primaryKey = 'id_clo';

    protected $fillable = [
        'id_mk',
        'nama_clo',
        'description_clo',
    ];

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'id_mk', 'id_mk');
    }

    public function assessmentTools()
    {
        return $this->hasMany(AssessmentTool::class, 'id_clo', 'id_clo');
    }

    public function plos()
    {
        return $this->belongsToMany(
            Plo::class,
            'pivot_clo_plo',
            'id_clo',
            'id_plo'
        )->withPivot('percentage_weight');
    }
}
