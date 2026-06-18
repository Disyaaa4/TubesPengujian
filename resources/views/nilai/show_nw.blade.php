@extends('layout.app_nw')

@section('title', 'Detail Nilai PLO - COMPASS')
@section('headerTitle', 'Student Competency Oversight | Classroom Section Lens')

@section('styles')
    @vite(['resources/css/nilai.css', 'resources/css/nilai_detail.css'])
@endsection

@section('content')
    <section class="detail-nilai-wrapper">
        <div class="nilai-title">Student Competency Oversight</div>

        <div class="detail-card">
            <div class="student-row">
                {{ $mahasiswa->nim }} / {{ strtoupper($mahasiswa->nama) }}
            </div>

            <div class="plo-info">
                <h2>{{ $plo->nama_plo }}</h2>
                <p>
                    {{ $plo->description_plo }}
                </p>
            </div>

            <h3>Detail Nilai PLO</h3>

            <div class="record-row">
                <span class="record-box"></span>
                <span>Record per pages</span>
            </div>

            <div class="detail-table-wrap">
                <table class="detail-table">
                    <thead>
                        <tr>
                            <th>Kode MK</th>
                            <th>Nama MK</th>
                            <th>Semester</th>
                            <th>SKS</th>
                            <th>Nilai CLO</th>
                            <th>Detail Nilai PLO</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($cloResults as $index => $clo)
                            @php
                                $cloRowId = 'clo-row-' . $index;
                                $toolsId = 'tools-row-' . $index;
                            @endphp

                            <tr class="mk-row" onclick="toggleClo('{{ $cloRowId }}')">
                                <td>{{ $clo['kode_mk'] ?? '-' }}</td>
                                <td>{{ $clo['nama_matakuliah'] ?? '-' }}</td>
                                <td>{{ $clo['semester'] ?? '-' }}</td>
                                <td>{{ $clo['sks'] ?? '-' }}</td>
                                <td>
                                    {{ isset($clo['final_clo_score']) ? number_format($clo['final_clo_score'], 2) : '-' }}
                                </td>
                                <td>
                                    {{ $clo['kode_clo'] ?? ($clo['nama_clo'] ?? 'Detail CLO') }}
                                </td>
                            </tr>

                            <tr id="{{ $cloRowId }}" class="clo-row">
                                <td colspan="6" class="clo-cell">
                                    <div class="clo-block">
                                        <div class="clo-line" onclick="toggleTools(event, '{{ $toolsId }}')">
                                            <strong>{{ $clo['kode_clo'] ?? ($clo['nama_clo'] ?? 'CLO') }}</strong>
                                            <span>:{{ isset($clo['final_clo_score']) ? number_format($clo['final_clo_score'], 2) : '-' }}</span>
                                        </div>

                                        <div id="{{ $toolsId }}" class="assessment-tools show">
                                            @forelse (($clo['assessments'] ?? $clo['tools'] ?? []) as $tool)
                                                <div>
                                                    {{ $tool['nama_at'] ?? ($tool['nama_assessment'] ?? '-') }}
                                                    <span>:{{ isset($tool['score']) ? number_format($tool['score'], 2) : '-' }}</span>
                                                </div>
                                            @empty
                                                <div>
                                                    Assessment tools belum tersedia
                                                    <span>: -</span>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    Detail nilai untuk PLO ini belum tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script>
        function toggleClo(id) {
            const row = document.getElementById(id);

            if (!row) return;

            row.classList.toggle('show');
        }

        function toggleTools(event, id) {
            event.stopPropagation();

            const tools = document.getElementById(id);

            if (!tools) return;

            tools.classList.toggle('show');
        }
    </script>
@endsection
