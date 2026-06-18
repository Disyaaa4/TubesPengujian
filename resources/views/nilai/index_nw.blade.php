@extends('layout.app_nw')

@section('title', 'Nilai - COMPASS')
@section('headerTitle', 'Student Competency Oversight | Classroom Section Lens')
@section('styles')
    @vite('resources/css/nilai.css')
@endsection

@section('content')

    {{-- CONTENT --}}
    <main class="nilai-wrapper">

        <div class="nilai-title">
            Student Competency Oversight
        </div>

        {{-- FILTER --}}
        <div class="filter-section">

            <div class="filter-item">
                <label>Kurikulum</label>
                <select>
                    <option>2024</option>
                </select>
            </div>

            <div class="filter-item">
                <label>Angkatan</label>
                <select>
                    <option>2024</option>
                </select>
            </div>

            <div class="filter-item">
                <label>Periode Akademik</label>
                <select>
                    <option>2024/1</option>
                </select>
            </div>

            <div class="filter-item">
                <label>Kode Dosen</label>
                <select>
                    <option>TRL</option>
                </select>
            </div>

            <button class="apply-btn">
                Apply
            </button>
        </div>

        {{-- INFO --}}
        <div class="info-box">
            <strong>INFO !!!</strong><br>

            TEMPAT INFORMASI <br>

            | INFORMASI A |
            INFORMASI B |
            INFORMASI C |
            INFORMASI D |
        </div>

        {{-- TABLE --}}
        <div class="table-card">
            <div class="table-responsive">
                <table class="nilai-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Kode Dosen</th>

                            @foreach ($plos as $plo)
                                <th>{{ $plo->nama_plo }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rows as $index => $row)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $row['mahasiswa']->nim }}</td>
                                <td>{{ $row['mahasiswa']->nama }}</td>
                                <td>{{ $row['mahasiswa']->kode_dosen ?? '-' }}</td>

                                @foreach ($plos as $plo)
                                    @php
                                        $nilaiPlo = $row['plos'][$plo->id_plo] ?? null;
                                    @endphp

                                    <td>
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
                                <td colspan="{{ 4 + $plos->count() }}" class="text-center">
                                    Data nilai belum tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

@endsection
