<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataAkademik;

class DataAkademikController extends Controller
{
    public function index()
    {
        $dataAkademik = DataAkademik::all();

        return view('data-akademik.index', compact('dataAkademik'));
    }

    public function store(Request $request)
    {
        DataAkademik::create([
            'kurikulum' => $request->kurikulum,
            'angkatan' => $request->angkatan,
            'periode_akademik' => $request->periode_akademik,
            'kode_dosen' => $request->kode_dosen,
        ]);

        return redirect()
                ->back()
                ->with('success', 'Data berhasil disimpan');
    }
}
