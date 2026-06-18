@extends('layout.app_nw')

@section('title', 'Input Nilai Mahasiswa Perwalian - COMPASS')
@section('headerTitle', 'Input Nilai Mahasiswa Perwalian')
@section('styles')
    @vite('resources/css/nilai.css')
    <style>
        .nilai-wrapper {
            background: #E8F8F5 !important;
        }
        .nilai-title {
            background: #A3E4D7 !important;
            color: #0E6251 !important;
            font-weight: bold;
        }
        .info-box {
            background: #D1F2EB !important;
            border-left: 4px solid #1ABC9C;
            color: #0E6251 !important;
        }
        .nilai-table th {
            background: #E8F6F3 !important;
        }
        .nilai-table tbody tr:nth-child(even) {
            background: #F4FCFA !important;
        }
        .btn-input {
            background: #1ABC9C;
            color: white;
            padding: 6px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
        }
        .btn-input:hover {
            background: #16A085;
            color: white;
        }
    </style>
@endsection

@section('content')
    <main class="nilai-wrapper">
        <div class="nilai-title">
            Input Nilai Mahasiswa Perwalian
        </div>

        <div class="info-box">
            <strong>PETUNJUK INPUT NILAI</strong><br>
            Pilih mahasiswa dari daftar di bawah ini untuk menginput/memperbarui nilai komponen assessment (CLO). 
            Hanya menampilkan daftar mahasiswa perwalian Anda (Kode Dosen: {{ $user->kode_dosen ?? '-' }}).
        </div>

        <div class="table-card">
            <div class="table-responsive">
                <table class="nilai-table">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th style="width: 150px;">NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mahasiswas as $index => $mahasiswa)
                            <tr>
                                <td style="text-align: center;">{{ $index + 1 }}</td>
                                <td style="text-align: center;">{{ $mahasiswa->nim }}</td>
                                <td>{{ $mahasiswa->nama }}</td>
                                <td style="text-align: center;">
                                    <a href="{{ route('dosen-wali.input-nilai.show', $mahasiswa->id_mahasiswa) }}" class="btn-input">
                                        Input Nilai
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="text-align: center;">
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
