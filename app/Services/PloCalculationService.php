<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class PloCalculationService
{
    public function calculate($idMahasiswa)
    {
        $assessmentScores = DB::table('nilai_mahasiswa')
            ->join('assessment_tools', 'nilai_mahasiswa.id_at', '=', 'assessment_tools.id_at')
            ->join('data_clo', 'assessment_tools.id_clo', '=', 'data_clo.id_clo')
            ->join('mata_kuliah', 'data_clo.id_mk', '=', 'mata_kuliah.id_mk')
            ->join('pivot_clo_plo', 'data_clo.id_clo', '=', 'pivot_clo_plo.id_clo')
            ->join('data_plo', 'pivot_clo_plo.id_plo', '=', 'data_plo.id_plo')
            ->where('nilai_mahasiswa.id_mahasiswa', $idMahasiswa)
            ->select(
                'data_plo.id_plo',
                'data_plo.nama_plo',
                'data_plo.description_plo',

                'data_clo.id_clo',
                'data_clo.nama_clo',
                'data_clo.description_clo',

                'mata_kuliah.id_mk',
                'mata_kuliah.kode_mk',
                'mata_kuliah.nama_matakuliah',
                'mata_kuliah.sks',
                'mata_kuliah.semester',

                'assessment_tools.id_at',
                'assessment_tools.nama_at',
                'assessment_tools.weight_in_clo',

                'nilai_mahasiswa.score'
            )
            ->get();

        $cloResults = [];

        foreach ($assessmentScores as $row) {
            if (!isset($cloResults[$row->id_clo])) {
                $cloResults[$row->id_clo] = [
                    'id_clo' => $row->id_clo,
                    'nama_clo' => $row->nama_clo,
                    'description_clo' => $row->description_clo,

                    'id_plo' => $row->id_plo,
                    'nama_plo' => $row->nama_plo,
                    'description_plo' => $row->description_plo,

                    'id_mk' => $row->id_mk,
                    'kode_mk' => $row->kode_mk,
                    'nama_matakuliah' => $row->nama_matakuliah,
                    'sks' => $row->sks,
                    'semester' => $row->semester,

                    'total_score' => 0,
                    'total_weight' => 0,
                    'final_clo_score' => 0,

                    'assessments' => [],
                ];
            }

            $score = (float) $row->score;
            $weight = (float) $row->weight_in_clo;

            $cloResults[$row->id_clo]['total_score'] += ($score * $weight);
            $cloResults[$row->id_clo]['total_weight'] += $weight;

            $cloResults[$row->id_clo]['assessments'][] = [
                'id_at' => $row->id_at,
                'nama_at' => $row->nama_at,
                'weight_in_clo' => $weight,
                'score' => $score,
                'weighted_score' => $score * $weight,
            ];
        }

        foreach ($cloResults as $idClo => $clo) {
            $cloResults[$idClo]['final_clo_score'] =
                $clo['total_weight'] > 0
                    ? round($clo['total_score'] / $clo['total_weight'], 2)
                    : 0;
        }

        $ploResults = [];

        foreach ($cloResults as $clo) {
            $ploId = $clo['id_plo'];

            if (!isset($ploResults[$ploId])) {
                $ploResults[$ploId] = [
                    'id_plo' => $ploId,
                    'nama_plo' => $clo['nama_plo'],
                    'description_plo' => $clo['description_plo'],
                    'total_clo_score' => 0,
                    'total_clo' => 0,
                    'final_plo_score' => 0,
                    'clos' => [],
                ];
            }

            $ploResults[$ploId]['total_clo_score'] += $clo['final_clo_score'];
            $ploResults[$ploId]['total_clo']++;

            $ploResults[$ploId]['clos'][] = $clo;
        }

        foreach ($ploResults as $ploId => $plo) {
            $ploResults[$ploId]['final_plo_score'] =
                $plo['total_clo'] > 0
                    ? round($plo['total_clo_score'] / $plo['total_clo'], 2)
                    : 0;
        }

        return [
            'clo_results' => $cloResults,
            'plo_results' => $ploResults,
        ];
    }
}
