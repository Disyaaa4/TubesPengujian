@extends('layout.app_nw')

@section('title', 'Mata Kuliah - COMPASS')
@section('headerTitle', 'Mata Kuliah')

@section('styles')
    @vite('resources/css/mata_kuliah.css')
@endsection

@section('content')
    <section class="mk-wrapper">
        <div class="mk-title">Kelola Mata Kuliah</div>

        <div class="mk-filter">
            <div class="filter-row">
                <label>Kurikulum</label>
                <select>
                    <option>2024</option>
                </select>
            </div>

            <div class="filter-row">
                <label>Periode Akademik</label>
                <select>
                    <option>2025/2026 Semester Ganjil</option>
                </select>
            </div>

            <button class="mk-apply-btn">Apply</button>
        </div>

        <div class="mk-info-box">
            Tempat Info
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
                        <th>SKS</th>
                        <th>Semester</th>
                        <th>Tahun Akademik</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @php
                        $matkul = [
                            ['BBK1AAB4', 'ALGORITMA DAN PEMROGRAMAN', 4, 1, 2526, 'Active'],
                            ['BBK1BAB3', 'MATEMATIKA DISKRIT', 3, 1, 2526, 'Active'],
                            ['BBK1CAB3', 'MATEMATIKA UNTUK SISTEM INFORMASI', 3, 1, 2526, 'Active'],
                            ['BBK1DAB3', 'PENGANTAR SISTEM INFORMASI', 3, 1, 2526, 'Active'],
                            ['BBK1CAB3', 'MATEMATIKA UNTUK SISTEM INFORMASI', 3, 1, 2526, 'Active'],
                        ];
                    @endphp

                    @foreach ($matkul as $index => $mk)
                        <tr>
                            <td>{{ $index + 1 }}.</td>
                            <td>{{ $mk[0] }}</td>
                            <td>{{ $mk[1] }}</td>
                            <td>{{ $mk[2] }}</td>
                            <td>{{ $mk[3] }}</td>
                            <td>{{ $mk[4] }}</td>
                            <td>{{ $mk[5] }}</td>
                            <td>
                                <div class="action-group">
                                    <button type="button" class="btn-edit"
                                        onclick="openEditMkModal('{{ $mk[0] }}')">
                                        Edit
                                    </button>

                                    <a href="{{ route('mata-kuliah.manage-plo.ui') }}" class="btn-manage">
                                        Manage PLO
                                    </a>

                                    <button type="button" class="btn-detail"
                                        onclick="openDetailAtModal('{{ $mk[0] }}')">
                                        Detail
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- MODAL EDIT MATA KULIAH --}}
        <div id="editMkModal" class="modal-overlay">
            <div class="edit-mk-modal">
                <div class="modal-header-custom edit-modal-header">
                    <h3>Edit Manage PLO</h3>
                    <button type="button" onclick="closeEditMkModal()">×</button>
                </div>

                <div class="modal-info-box"></div>

                <div class="edit-modal-body">
                    <div class="edit-field-group">
                        <label>Kode Mata Kuliah</label>
                        <div class="edit-field-value">
                            <span id="editMkCode" class="edit-code-text"></span>
                        </div>
                    </div>

                    <div class="edit-field-group">
                        <label>Status Aktif PLO</label>
                        <label class="switch">
                            <input id="editMkStatus" type="checkbox">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>

                <div class="modal-footer-custom modal-footer-edit">
                    <button type="button" class="btn-cancel" onclick="closeEditMkModal()">Cancel</button>
                    <button type="button" class="btn-save" onclick="saveMkChanges()">Save</button>
                </div>
            </div>
        </div>

        {{-- MODAL DETAIL ASSESSMENT TOOLS --}}
        <div id="detailAtModal" class="modal-overlay">
            <div class="detail-at-modal">
                <div class="modal-header-custom detail-header">
                    <h3>Detail Assessment Tools</h3>
                    <button type="button" onclick="closeDetailAtModal()">×</button>
                </div>

                <div class="detail-meta-row">
                    <div class="detail-meta-item">
                        <label>Kode Mata Kuliah</label>
                        <div class="detail-meta-box">
                            <span id="detailMkCode"></span>
                        </div>
                    </div>

                    <div class="detail-meta-item">
                        <label>Tahun Akademik</label>
                        <div class="detail-meta-box">
                            <span id="detailMkTahun"></span>
                        </div>
                    </div>
                </div>

                <div class="detail-table-wrap">
                    <table class="detail-at-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama assessment tools</th>
                                <th>Persentase assessment tools</th>
                                <th>Nama Komponen</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>UAS CLO 1</td>
                                <td>10</td>
                                <td>Ujian Akhir Semester</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>TUGAS 2 CLO 6</td>
                                <td>5</td>
                                <td>Tugas</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>QUIZ 2 CLO 6</td>
                                <td>10</td>
                                <td>Tugas Akhir</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>TUGAS 2 CLO 1</td>
                                <td>5</td>
                                <td>Tugas</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>QUIZ 2 CLO 1</td>
                                <td>5</td>
                                <td>Tugas Akhir</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="detail-footer detail-footer-detail">
                    <p>Showing 1 to 5 of 5 entries</p>
                    <button type="button" class="btn-close-detail" onclick="closeDetailAtModal()">Close</button>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        const matkulData = @json($matkul);

        function openEditMkModal(kode) {
            const matkul = matkulData.find(item => item[0] === kode);

            if (!matkul) {
                return;
            }

            document.getElementById('editMkCode').textContent = matkul[0];
            document.getElementById('editMkStatus').checked = matkul[5] === 'Active';
            document.getElementById('editMkModal').classList.add('show');
        }

        function closeEditMkModal() {
            document.getElementById('editMkModal').classList.remove('show');
        }

        function saveMkChanges() {
            const kode = document.getElementById('editMkCode').textContent;
            const status = document.getElementById('editMkStatus').checked ? 'Active' : 'Inactive';

            alert(`Perubahan untuk ${kode} berhasil disimpan.\nStatus: ${status}`);
            closeEditMkModal();
        }

        function openDetailAtModal(kode) {
            const matkul = matkulData.find(item => item[0] === kode);

            if (!matkul) {
                return;
            }

            document.getElementById('detailMkCode').textContent = matkul[0];
            document.getElementById('detailMkTahun').textContent = matkul[4] + ' - Genap';
            document.getElementById('detailAtModal').classList.add('show');
        }

        function closeDetailAtModal() {
            document.getElementById('detailAtModal').classList.remove('show');
        }
    </script>
@endsection
