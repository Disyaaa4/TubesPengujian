<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Plo;
use App\Services\PloCalculationService;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index(Request $request, PloCalculationService $service)
    {
        $mahasiswas = Mahasiswa::query()
            ->when($request->filled('angkatan'), function ($query) use ($request) {
                $query->where('tahun_masuk', $request->angkatan);
            })
            ->when($request->filled('kode_dosen'), function ($query) use ($request) {
                $query->where('kode_dosen', $request->kode_dosen);
            })
            ->orderBy('nama')
            ->get();

        $plos = Plo::orderBy('id_plo')->get();

        $rows = $mahasiswas->map(function ($mahasiswa) use ($service, $plos) {
            $result = $service->calculate($mahasiswa->id_mahasiswa);
            $ploResults = collect($result['plo_results']);

            return [
                'mahasiswa' => $mahasiswa,
                'plos' => $plos->mapWithKeys(function ($plo) use ($ploResults) {
                    $score = $ploResults[$plo->id_plo]['final_plo_score'] ?? null;

                    return [
                        $plo->id_plo => $score !== null ? round($score, 2) : '-',
                    ];
                }),
            ];
        });

        return view('nilai.index_nw', compact('rows', 'plos'));
    }

    public function show($idMahasiswa, $idPlo, PloCalculationService $service)
    {
        $mahasiswa = Mahasiswa::findOrFail($idMahasiswa);
        $plo = Plo::findOrFail($idPlo);

        $result = $service->calculate($idMahasiswa);

        $cloResults = collect($result['clo_results'])
            ->filter(function ($clo) use ($idPlo) {
                return $clo['id_plo'] == $idPlo;
            })
            ->values();

        return view('nilai.show_nw', compact('mahasiswa', 'plo', 'cloResults'));
    }
}
