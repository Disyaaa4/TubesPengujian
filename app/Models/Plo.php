<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plo extends Model
{
    protected $table = 'data_plo';
    protected $primaryKey = 'id_plo';

    protected $fillable = [
        'nama_plo',
        'description_plo',
    ];

    public function clos()
    {
        return $this->belongsToMany(
            Clo::class,
            'pivot_clo_plo',
            'id_plo',
            'id_clo'
        )->withPivot('percentage_weight');
    }
}
