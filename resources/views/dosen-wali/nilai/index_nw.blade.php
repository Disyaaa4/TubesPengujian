@extends('layout.app_nw')

@section('title', 'Nilai Mahasiswa Perwalian - COMPASS')
@section('headerTitle', 'Nilai Mahasiswa Perwalian')
@section('styles')
    @vite('resources/css/nilai.css')
    <style>
        .nilai-wrapper {
            background: #FFF8E7 !important;
        }
        .nilai-title {
            background: #FFE5B4 !important;
            color: #8A5A19 !important;
            font-weight: bold;
        }
        .info-box {
            background: #FFF1D0 !important;
            border-left: 4px solid #F5B041;
            color: #8A5A19 !important;
        }
        .nilai-table th {
            background: #FDF2E9 !important;
        }
        .nilai-table tbody tr:nth-child(even) {
            background: #FFFDF8 !important;
        }
        .nilai-plo-link:hover {
            background: #FFE5B4 !important;
        }
    </style>
@endsection

@section('content')
    <main class="nilai-wrapper">
        <div class="nilai-title">
            Pemantauan Kompetensi Anak Perwalian
        </div>

        <div class="info-box">
            <strong>INFO PERWALIAN</strong><br>
            Berikut adalah daftar perolehan nilai PLO khusus untuk mahasiswa bimbingan Anda (Kode Dosen: {{ $user->kode_dosen ?? '-' }}).
        </div>

        <div class="table-card">
            <div class="table-responsive">
                <table class="nilai-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            @foreach ($plos as $plo)
                                <th>{{ $plo->nama_plo }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rows as $index => $row)
                            <tr>
                                <td style="text-align: center;">{{ $index + 1 }}</td>
                                <td style="text-align: center;">{{ $row['mahasiswa']->nim }}</td>
                                <td>{{ $row['mahasiswa']->nama }}</td>

                                @foreach ($plos as $plo)
                                    @php
                                        $nilaiPlo = $row['plos'][$plo->id_plo] ?? null;
                                    @endphp

                                    <td style="text-align: center;">
                                        @if ($nilaiPlo !== '-')
                                            <a href="{{ route('nilai.show', [
                                                'idMahasiswa' => $row['mahasiswa']->id_mahasiswa,
                                                'idPlo' => $plo->id_plo,
                                            ]) }}"
                                                class="nilai-plo-link">
                                                {{ number_format($nilaiPlo, 2) }}
                                            </a>
                                        @else
                                            <span>-</span>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ 3 + $plos->count() }}" style="text-align: center;">
                                    Belum ada data mahasiswa perwalian.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
