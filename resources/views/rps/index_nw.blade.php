@extends('layout.app_nw')

@section('title', 'RPS - COMPASS')
@section('headerTitle', 'RPS')

@section('styles')
    @vite('resources/css/mata_kuliah.css')
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
            <strong>INFO !!!</strong><br>
            Halaman ini menampilkan daftar dokumen RPS mata kuliah berdasarkan kurikulum dan semester.
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
                        <th>No</th>
                        <th>Kode Mata Kuliah</th>
                        <th>Nama Mata Kuliah</th>
                        <th>Semester</th>
                        <th>Jenis Mata Kuliah</th>
                        <th>Dokumen RPS</th>
                    </tr>
                </thead>

                <tbody>
                    @php
                        $rpsData = [
                            ['BBK1AAB4', 'ALGORITMA PEMROGRAMAN', 1, 'Wajib', '#'],
                            ['BBK1BAB3', 'MATEMATIKA DISKRIT', 1, 'Wajib', '#'],
                            ['BBK1EAB3', 'SISTEM ENTERPRISE', 1, 'Wajib', '#'],
                            ['BBK1FAB3', 'DESIGN THINKING', 2, 'Wajib', '#'],
                            ['BBK1GAB3', 'JARINGAN KOMPUTER', 2, 'Wajib', '#'],
                            ['BBK1JAB3', 'SISTEM BASIS DATA', 2, 'Wajib', '#'],
                        ];
                    @endphp

                    @foreach ($rpsData as $i => $rps)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $rps[0] }}</td>
                            <td>{{ $rps[1] }}</td>
                            <td>{{ $rps[2] }}</td>
                            <td>{{ $rps[3] }}</td>
                            <td>
                                <a href="{{ $rps[4] }}" class="btn btn-sm btn-secondary">
                                    Lihat RPS
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mk-pagination">
            <button>First</button>
            <button>Previous</button>
            <button class="active">1</button>
            <button>2</button>
            <button>Next</button>
            <button>Last</button>
        </div>
    </section>
@endsection
