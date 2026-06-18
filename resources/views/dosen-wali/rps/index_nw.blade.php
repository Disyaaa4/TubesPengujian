@extends('layout.app_nw')

@section('title', 'RPS Mata Kuliah - COMPASS')
@section('headerTitle', 'Rencana Pembelajaran Semester')

@section('styles')
    @vite('resources/css/mata_kuliah.css')
    <style>
        /* Override Styles for Dosen Wali RPS Theme (Purple) */
        .mk-wrapper {
            background-color: #FAF5FF !important; 
        }
        .mk-title {
            background-color: #D8B4FE !important;
            color: #4C1D95 !important;
            padding: 12px 18px !important;
            font-weight: bold;
            font-size: 16px;
            border-radius: 6px;
            margin-bottom: 24px;
        }
        .mk-filter {
            background-color: #F3E8FF !important;
            border-radius: 8px;
            border-left: 5px solid #9333EA;
            padding: 20px;
        }
        .mk-info-box {
            background-color: #E9D5FF !important;
            color: #4C1D95 !important;
            border-left: 5px solid #7C3AED !important;
            margin-bottom: 24px;
        }
        .mk-table th {
            background-color: #7C3AED !important;
            color: #FFFFFF !important;
            font-weight: 600;
        }
        .mk-table tbody tr:nth-child(even) {
            background-color: #F5F3FF !important;
        }
        .mk-table tbody tr:hover {
            background-color: #EDE9FE !important;
        }
        .btn-lihat-rps {
            background-color: #9333EA;
            color: white;
            padding: 6px 16px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            display: inline-block;
            transition: background-color 0.2s;
        }
        .btn-lihat-rps:hover {
            background-color: #7C3AED;
            color: white;
        }
        .mk-apply-btn {
            background-color: #9333EA !important;
            border: none;
            color: white !important;
        }
    </style>
@endsection

@section('content')
    <section class="mk-wrapper">
        <div class="mk-title">Rencana Pembelajaran Semester (RPS)</div>

        <div class="mk-filter">
            <div class="filter-row">
                <label>Tahun Kurikulum</label>
                <select>
                    <option>2024</option>
                    <option>2025</option>
                </select>
            </div>

            <div class="filter-row">
                <label>Semester</label>
                <select>
                    <option>Semua Semester</option>
                    <option>Semester 1</option>
                    <option>Semester 2</option>
                    <option>Semester 3</option>
                    <option>Semester 4</option>
                    <option>Semester 5</option>
                    <option>Semester 6</option>
                    <option>Semester 7</option>
                    <option>Semester 8</option>
                </select>
            </div>

            <button class="mk-apply-btn">Apply</button>
        </div>

        <div class="mk-info-box">
            <strong>INFORMASI RPS DOSEN WALI</strong><br>
            Halaman ini menampilkan daftar dokumen Rencana Pembelajaran Semester (RPS). Dosen Wali dapat mengakses RPS ini untuk membantu memberikan arahan atau konsultasi perwalian kepada mahasiswa.
        </div>

        <div class="mk-table-top">
            <div>
                <span class="record-box"></span>
                <span>Record per pages</span>
            </div>

            <div>
                <label>Search (Press Enter):</label>
                <input type="text">
            </div>
        </div>

        <div class="mk-table-wrap">
            <table class="mk-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th style="width: 150px;">Kode Mata Kuliah</th>
                        <th>Nama Mata Kuliah</th>
                        <th style="width: 100px;">Semester</th>
                        <th style="width: 80px;">SKS</th>
                        <th style="width: 140px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($mataKuliahs as $i => $mk)
                        <tr>
                            <td style="text-align: center;">{{ $i + 1 }}</td>
                            <td style="text-align: center; font-weight: bold;">{{ $mk->kode_mk }}</td>
                            <td>{{ $mk->nama_matakuliah }}</td>
                            <td style="text-align: center;">{{ $mk->semester }}</td>
                            <td style="text-align: center;">{{ $mk->sks }}</td>
                            <td style="text-align: center;">
                                <a href="#" class="btn-lihat-rps">
                                    Lihat RPS
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 20px;">Belum ada data mata kuliah yang tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mk-pagination">
            <button>First</button>
            <button>Previous</button>
            <button class="active" style="background-color: #9333EA; color: white; border: none;">1</button>
            <button>2</button>
            <button>Next</button>
            <button>Last</button>
        </div>
    </section>
@endsection
