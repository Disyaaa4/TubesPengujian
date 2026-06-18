@extends('layout.app_nw')

@section('title', 'Input Nilai Mahasiswa - COMPASS')
@section('headerTitle', 'Input Nilai Mahasiswa')

@section('styles')
    @vite('resources/css/nilai.css')
    <style>
        .nilai-wrapper { background: #E8F8F5 !important; }
        .nilai-title { background: #A3E4D7 !important; color: #0E6251 !important; font-weight: bold; }
        .info-box { background: #D1F2EB !important; border-left: 4px solid #1ABC9C; color: #0E6251 !important; margin-bottom: 24px; padding: 14px; font-size: 14px;}
        .subject-card { background: white; border-radius: 8px; margin-bottom: 24px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .subject-header { background: #1ABC9C; color: white; padding: 12px 20px; font-weight: bold; font-size: 16px; }
        .subject-body { padding: 20px; }
        .at-table { width: 100%; border-collapse: collapse; }
        .at-table th, .at-table td { border: 1px solid #E5E7EB; padding: 10px; text-align: left; }
        .at-table th { background: #F9FAFB; font-weight: 600; font-size: 14px; }
        .input-score { width: 80px; padding: 6px 10px; border: 1px solid #D1D5DB; border-radius: 4px; text-align: right; }
        .btn-save-all { background: #0E6251; color: white; padding: 10px 24px; border: none; border-radius: 6px; font-size: 16px; font-weight: bold; cursor: pointer; float: right; margin-bottom: 40px; }
        .btn-save-all:hover { background: #0B5345; }
        .alert-success { background: #D4EDDA; color: #155724; padding: 12px 20px; border-radius: 4px; border-left: 4px solid #28A745; margin-bottom: 24px; }
    </style>
@endsection

@section('content')
<main class="nilai-wrapper">
    <div class="nilai-title">
        Form Input Nilai: {{ $mahasiswa->nama }} ({{ $mahasiswa->nim }})
    </div>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="info-box">
        Silakan isi nilai pada kolom <strong>Nilai</strong> untuk setiap komponen Assessment Tools. Jika nilai belum ada, biarkan kosong. Nilai berada dalam rentang 0 - 100.
    </div>

    <form action="{{ route('dosen-wali.input-nilai.store', $mahasiswa->id_mahasiswa) }}" method="POST">
        @csrf

        @foreach($mataKuliahs as $mk)
            @php
                // Cek apakah mata kuliah ini punya assessment tools
                $hasAT = false;
                foreach($mk->clos as $clo) {
                    if($clo->assessmentTools->count() > 0) {
                        $hasAT = true;
                        break;
                    }
                }
            @endphp

            @if($hasAT)
                <div class="subject-card">
                    <div class="subject-header">
                        {{ $mk->kode_mk }} - {{ $mk->nama_matakuliah }}
                    </div>
                    <div class="subject-body">
                        <table class="at-table">
                            <thead>
                                <tr>
                                    <th>CLO</th>
                                    <th>Assessment Tool</th>
                                    <th style="text-align: center;">Bobot (%)</th>
                                    <th style="width: 120px; text-align: center;">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mk->clos as $clo)
                                    @foreach($clo->assessmentTools as $at)
                                        <tr>
                                            @if($loop->first)
                                                <td rowspan="{{ $clo->assessmentTools->count() }}" style="vertical-align: top; width: 30%;">
                                                    <strong>{{ $clo->nama_clo }}</strong><br>
                                                    <small style="color: #6B7280;">{{ $clo->description_clo }}</small>
                                                </td>
                                            @endif
                                            <td>{{ $at->nama_at }}</td>
                                            <td style="text-align: center;">{{ $at->weight_in_clo }}%</td>
                                            <td style="text-align: center;">
                                                <input type="number" 
                                                       name="nilai[{{ $at->id_at }}]" 
                                                       value="{{ isset($nilaiMahasiswa[$at->id_at]) ? $nilaiMahasiswa[$at->id_at]->score : '' }}" 
                                                       class="input-score" 
                                                       step="0.01" 
                                                       min="0" 
                                                       max="100" 
                                                       placeholder="-">
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        @endforeach

        <div style="overflow: hidden;">
            <button type="submit" class="btn-save-all">
                Simpan Semua Nilai
            </button>
        </div>
    </form>
</main>
@endsection
