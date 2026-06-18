@extends('layout.app_nw')

@section('title', 'Lihat Mata Kuliah - COMPASS')
@section('headerTitle', 'Mata Kuliah')

@section('styles')
    @vite([
        'resources/css/dashboard.css',
        'resources/css/mata_kuliah.css'
    ])
@endsection

@section('content')
    <section class="mk-wrapper">
        <div class="mk-title">Lihat Mata Kuliah</div>

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
            <table class="mk-table mk-lihat-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Mata Kuliah</th>
                        <th>Nama Mata Kuliah</th>
                        <th>Program Studi</th>
                        <th>Semester</th>
                        <th>Tahun Akademik</th>
                    </tr>
                </thead>

                <tbody>
                    @php
                        $data = [
                            ['UBKXBCB2', 'PANCASILA', 'S1 Sistem Informasi - Kampus Surabaya', 8, 2425],
                            ['BBK1GAB3', 'JARINGAN KOMPUTER', 'S1 Sistem Informasi - Kampus Surabaya', 2, 2425],
                            ['UAKXACB2', 'AGAMA ISLAM', 'S1 Sistem Informasi - Kampus Surabaya', 1, 2425],
                            ['UAKXADB2', 'AGAMA KRISTEN', 'S1 Sistem Informasi - Kampus Surabaya', 1, 2425],
                            ['UAKXAEB2', 'AGAMA KATOLIK', 'S1 Sistem Informasi - Kampus Surabaya', 1, 2425],
                            ['UBKXACB2', 'KEWARGANEGARAAN', 'S1 Sistem Informasi - Kampus Surabaya', 8, 2425],
                            ['UCK1FDB1', 'INTERNALISASI BUDAYA DAN PEMBENTUKAN KARAKTER', 'S1 Sistem Informasi - Kampus Surabaya', 1, 2425],
                            ['BBK1AAB4', 'ALGORITMA PEMROGRAMAN', 'S1 Sistem Informasi - Kampus Surabaya', 1, 2425],
                            ['BBK1EAB3', 'SISTEM ENTERPRISE', 'S1 Sistem Informasi - Kampus Surabaya', 1, 2425],
                            ['BBK1BAB3', 'MATEMATIKA DISKRIT', 'S1 Sistem Informasi - Kampus Surabaya', 1, 2425],
                            ['BBK1FAB3', 'DESIGN THINKING', 'S1 Sistem Informasi - Kampus Surabaya', 2, 2425],
                            ['BBK1CAB3', 'KEPEMIMPINANAN DAN KOMUNIKASI INTERPERSONAL', 'S1 Sistem Informasi - Kampus Surabaya', 2, 2425],
                            ['BBK1IAB3', 'MANAJEMEN RANTAI PASOK', 'S1 Sistem Informasi - Kampus Surabaya', 1, 2425],
                            ['BBK1JAB3', 'SISTEM BASIS DATA', 'S1 Sistem Informasi - Kampus Surabaya', 2, 2425],
                        ];
                    @endphp

                    @foreach ($data as $i => $mk)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $mk[0] }}</td>
                            <td>{{ $mk[1] }}</td>
                            <td>{{ $mk[2] }}</td>
                            <td>{{ $mk[3] }}</td>
                            <td>{{ $mk[4] }}</td>
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
            <button>3</button>
            <button>4</button>
            <button>Next</button>
            <button>Last</button>
        </div>
    </section>
@endsection
