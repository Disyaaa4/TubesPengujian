<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Plo;
use App\Services\PloCalculationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DosenWaliController extends Controller
{
    public function dashboard(\App\Services\PloCalculationService $service)
    {
        $user = Auth::user();
        $mahasiswas = \App\Models\Mahasiswa::where('kode_dosen', $user->kode_dosen)->get();
        $plos = \App\Models\Plo::orderBy('id_plo')->get();
        
        $totalMahasiswa = $mahasiswas->count();
        $totalPloRendah = 0;
        $totalPloScore = 0;
        $ploScoreCount = 0;

        $chartData = [];
        $studentStatuses = [];
        
        // Inisialisasi akumulator untuk PLO averages
        $ploAccumulator = [];
        $ploCounts = [];
        foreach ($plos as $plo) {
            $ploAccumulator[$plo->id_plo] = 0;
            $ploCounts[$plo->id_plo] = 0;
        }

        $totalAT = \App\Models\AssessmentTool::count(); // Asumsi total target AT per mahasiswa

        foreach ($mahasiswas as $mhs) {
            $result = $service->calculate($mhs->id_mahasiswa);
            $ploResults = collect($result['plo_results']);
            
            $avgPlo = $ploResults->avg('final_plo_score') ?? 0;
            
            if ($ploResults->count() > 0) {
                $totalPloScore += $avgPlo;
                $ploScoreCount++;
                
                if ($avgPlo < 60 && $avgPlo > 0) {
                    $totalPloRendah++;
                }
                
                // Kumpulkan nilai masing-masing PLO dari mahasiswa ini
                foreach ($ploResults as $id_plo => $ploData) {
                    $score = $ploData['final_plo_score'] ?? 0;
                    if ($score > 0) {
                        $ploAccumulator[$id_plo] += $score;
                        $ploCounts[$id_plo]++;
                    }
                }
            }

            // Status Kelengkapan Nilai
            $nilaiCount = \App\Models\NilaiMahasiswa::where('id_mahasiswa', $mhs->id_mahasiswa)->count();
            $status = 'Belum Ada';
            $progress = 0;
            if ($totalAT > 0) {
                $progress = round(($nilaiCount / $totalAT) * 100);
                if ($progress >= 100) $status = 'Lengkap';
                elseif ($progress > 0) $status = 'Sebagian';
            }
            
            $studentStatuses[] = [
                'nama' => $mhs->nama,
                'nim' => $mhs->nim,
                'progress' => $progress,
                'status' => $status
            ];
        }

        // Buat Chart Data berdasarkan PLO
        $ploIndex = 1;
        foreach ($plos as $plo) {
            $count = $ploCounts[$plo->id_plo];
            $avg = $count > 0 ? $ploAccumulator[$plo->id_plo] / $count : 0;
            
            $chartData[] = [
                'label' => sprintf('PLO%02d', $ploIndex), // Format "PLO01" - "PLO10"
                'value' => round($avg, 2),
                'color' => $avg > 0 ? ($avg < 60 ? '#D32F2F' : '#3498DB') : '#B0BEC5' // Abu-abu jika belum ada nilai
            ];
            $ploIndex++;
        }

        $rataRataPlo = $ploScoreCount > 0 ? round($totalPloScore / $ploScoreCount, 2) : 0;

        // Histori aktivitas (Input Nilai terbaru)
        $recentActivities = \App\Models\NilaiMahasiswa::with(['mahasiswa', 'assessmentTool.clo.mataKuliah'])
            ->whereIn('id_mahasiswa', $mahasiswas->pluck('id_mahasiswa'))
            ->orderBy('updated_at', 'desc')
            ->take(8)
            ->get();

        return view('dosen-wali.dashboard.index_nw', compact(
            'user',
            'totalMahasiswa',
            'rataRataPlo',
            'totalPloRendah',
            'chartData',
            'studentStatuses',
            'recentActivities'
        ));
    }

    public function nilaiPerwalian(Request $request, \App\Services\PloCalculationService $service)
    {
        $user = Auth::user();
        
        $mahasiswas = Mahasiswa::query()
            ->where('kode_dosen', $user->kode_dosen)
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

        return view('dosen-wali.nilai.index_nw', compact('rows', 'plos', 'user'));
    }

    public function inputNilai()
    {
        $user = Auth::user();
        
        $mahasiswas = Mahasiswa::query()
            ->where('kode_dosen', $user->kode_dosen)
            ->orderBy('nama')
            ->get();
            
        return view('dosen-wali.input-nilai.index_nw', compact('mahasiswas', 'user'));
    }

    public function showInputNilai($id_mahasiswa)
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('kode_dosen', $user->kode_dosen)->findOrFail($id_mahasiswa);

        // Ambil semua mata kuliah beserta CLO dan Assessment Tools-nya
        $mataKuliahs = \App\Models\MataKuliah::with(['clos.assessmentTools'])->get();

        // Ambil nilai yang sudah ada untuk mahasiswa ini
        $nilaiMahasiswa = \App\Models\NilaiMahasiswa::where('id_mahasiswa', $id_mahasiswa)
            ->get()
            ->keyBy('id_at');

        return view('dosen-wali.input-nilai.show_nw', compact('mahasiswa', 'mataKuliahs', 'nilaiMahasiswa', 'user'));
    }

    public function storeInputNilai(Request $request, $id_mahasiswa)
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('kode_dosen', $user->kode_dosen)->findOrFail($id_mahasiswa);

        $data = $request->validate([
            'nilai' => 'array',
            'nilai.*' => 'nullable|numeric|min:0|max:100',
        ]);

        if (isset($data['nilai'])) {
            foreach ($data['nilai'] as $id_at => $score) {
                if ($score !== null) {
                    \App\Models\NilaiMahasiswa::updateOrCreate(
                        [
                            'id_mahasiswa' => $id_mahasiswa,
                            'id_at' => $id_at,
                        ],
                        [
                            'score' => $score,
                        ]
                    );
                } else {
                    // Jika dikosongkan (null), maka hapus datanya
                    \App\Models\NilaiMahasiswa::where('id_mahasiswa', $id_mahasiswa)
                        ->where('id_at', $id_at)
                        ->delete();
                }
            }
        }

        return redirect()->route('dosen-wali.input-nilai.show', $id_mahasiswa)
            ->with('success', 'Nilai berhasil disimpan.');
    }

    public function rps()
    {
        $user = Auth::user();
        $mataKuliahs = \App\Models\MataKuliah::orderBy('semester')->get();
        return view('dosen-wali.rps.index_nw', compact('mataKuliahs', 'user'));
    }
}
