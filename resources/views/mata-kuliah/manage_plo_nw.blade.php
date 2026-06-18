@extends('layout.app_nw')

@section('title', 'Manage PLO Mata Kuliah')

@vite('resources/css/mata_kuliah.css')

@section('content')

    <div class="dashboard-page">

        @include('components.sidebar_nw')

        <main class="dashboard-main">

            {{-- HEADER --}}
            <header class="dashboard-header">
                <button class="mobile-menu-btn" onclick="toggleSidebar()">☰</button>

                <h1>Mata Kuliah</h1>

                <div class="header-actions">
                    <input type="text" placeholder="Search">

                    <span class="notif">3</span>
                    <div class="avatar"></div>
                    <span>⌄</span>
                </div>
            </header>

            {{-- CONTENT --}}
            <section class="mk-wrapper">

                <div class="mk-title-bar">
                    <span>📝</span>
                    <p>Kelola Mata Kuliah</p>
                </div>

                {{-- FILTER --}}
                <div class="mk-filter-area">

                    <div class="mk-filter-group">
                        <label>Tahun Kurikulum</label>

                        <select>
                            <option>2024</option>
                        </select>
                    </div>

                    <div class="mk-filter-group">
                        <label>Kode Mata Kuliah</label>

                        <select>
                            <option>BBK1AAB4</option>
                        </select>
                    </div>

                    <div class="mk-filter-group">
                        <label>Nama Mata Kuliah</label>

                        <select>
                            <option>ALGORITMA DAN PEMROGRAMAN</option>
                        </select>
                    </div>

                </div>

                {{-- INFO --}}
                <div class="mk-info-box">
                    Tempat Info
                </div>

                {{-- ADD BUTTON --}}
                <div class="mk-add-btn-wrap">
                    <button type="button" class="mk-add-btn" onclick="openAddPloModal()">
                        + Add PLO
                    </button>
                </div>

                {{-- ALERT --}}
                <div class="mk-alert-success"></div>

                {{-- TABLE TOP --}}
                <div class="mk-table-top">
                    <div class="record-pages">
                        <span class="record-box"></span>
                        <p>Record per pages</p>
                    </div>

                    <div class="table-search">
                        <label>Search (Press Enter):</label>
                        <input type="text">
                    </div>
                </div>

                {{-- TABLE --}}
                <div class="mk-table-wrapper">

                    <table class="mk-table">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>PLO</th>
                                <th>Total CLO</th>
                                <th>Status Aktif PLO Pemetaan</th>
                                <th>Status Aktif PLO</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr>
                                <td>1</td>

                                <td class="plo-desc">
                                    PLO 01 Mampu menganalisis permasalahan infokom
                                    yang kompleks, mendefinisikan, dan memodelkan
                                    kebutuhan dalam konteks enterprise atau masyarakat
                                    dengan menerapkan ilmu dan pengetahuan dalam bidang
                                    komputasi, teknologi informasi dan komunikasi,
                                    dan disiplin lain yang relevan
                                </td>

                                <td>30</td>

                                <td>Active</td>

                                <td>Active</td>

                                <td>
                                    <div class="action-group">
                                        <button type="button" class="btn-edit btn-edit-plo"
                                            onclick="openEditPloModal(this)"
                                            data-fakultas="Fakultas Rekayasa Industri"
                                            data-prodi="S1 Sistem Informasi"
                                            data-kurikulum="2024"
                                            data-nomor="1"
                                            data-deskripsi="PLO 01 Mampu menganalisis permasalahan infokom yang kompleks, mendefinisikan, dan memodelkan kebutuhan dalam konteks enterprise atau masyarakat dengan menerapkan ilmu dan pengetahuan dalam bidang komputasi, teknologi informasi dan komunikasi, dan disiplin lain yang relevan"
                                            data-status-mapping="Active"
                                            data-status-plo="Active">
                                            Edit
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>&nbsp;</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>&nbsp;</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

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

        </main>

    </div>

    <div id="sidebarOverlay" class="sidebar-overlay"></div>

    <script>
        function toggleSidebar() {
            document.querySelector('.dashboard-sidebar').classList.toggle('show');
            document.querySelector('.sidebar-overlay').classList.toggle('show');
        }
    </script>

    <div id="detailAtModal" class="modal-overlay">
        <div class="detail-at-modal">

            <div class="modal-header-custom">
                <h3>Detail Assessment Tools</h3>

                <button type="button" onclick="closeDetailAtModal()">
                    ×
                </button>
            </div>

            <div class="detail-top-form">

                <div class="detail-form-row">
                    <label>Kode Mata Kuliah</label>

                    <select>
                        <option>BBK1AAB4</option>
                    </select>
                </div>

                <div class="detail-form-row">
                    <label>Tahun Akademik</label>

                    <select>
                        <option>2024/2024 - Genap</option>
                    </select>
                </div>

            </div>

            <div class="detail-table-wrap">

                <table class="detail-at-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Assessment Tools</th>
                            <th>Persentase</th>
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

            <div class="detail-footer">

                <p>Showing 1 to 5 of 5 entries</p>

                <button type="button" class="btn-close-detail" onclick="closeDetailAtModal()">
                    Close
                </button>

            </div>

        </div>
    </div>

    <script>
        function openDetailAtModal() {
            document
                .getElementById('detailAtModal')
                .classList.add('show');
        }

        function closeDetailAtModal() {
            document
                .getElementById('detailAtModal')
                .classList.remove('show');
        }
    </script>

    <!-- add plo -->
    <div id="addPloModal" class="modal-overlay">
        <div class="add-plo-modal">

            <div class="modal-header-custom">
                <h3>Tambah PLO</h3>
                <button type="button" onclick="closeAddPloModal()">×</button>
            </div>

            <div class="add-plo-body">

                <div class="add-plo-row">
                    <label>Fakultas</label>
                    <select>
                        <option>Fakultas Rekayasa Industri</option>
                    </select>
                </div>

                <div class="add-plo-row">
                    <label>Program Studi</label>
                    <select>
                        <option>S1 Sistem Informasi</option>
                    </select>
                </div>

                <div class="add-plo-row">
                    <label>Tahun Kurikulum</label>
                    <select>
                        <option>2024</option>
                    </select>
                </div>

                <div class="add-plo-tabs">
                    <button type="button" class="tab-new active" onclick="showAddNewPlo()">
                        Add New
                    </button>

                    <button type="button" class="tab-select" onclick="showSelectPlo()">
                        Select PLO
                    </button>
                </div>

                <div id="addNewPloBox" class="add-plo-row textarea-row">
                    <label>Nama PLO</label>
                    <textarea>PLO 03</textarea>
                </div>

                <div id="selectPloBox" class="add-plo-row select-plo-row d-none">
                    <label>PLO</label>

                    <div class="plo-select-area">
                        <div class="plo-search-box">
                            <input type="text" id="ploSearchInput">
                            <button type="button" onclick="togglePloList()">🔍</button>
                        </div>

                        <div id="ploDropdownList" class="plo-dropdown-list">
                            <div class="plo-option"
                                onclick="selectPlo('[PLO 01] Mampu menganalisis permasalahan infokom yang kompleks, mendefinisikan, dan memodelkan kebutuhan dalam konteks enterprise atau masyarakat dengan menerapkan ilmu disiplin lain yang relevan')">
                                [PLO 01] Mampu menganalisis permasalahan infokom yang kompleks, mendefinisikan, dan
                                memodelkan kebutuhan dalam konteks enterprise atau masyarakat dengan menerapkan ilmu
                                disiplin lain yang relevan
                            </div>

                            <div class="plo-option"
                                onclick="selectPlo('[PLO 02] Mampu merancang, mengembangkan, mengimplementasikan, dan mengevaluasi solusi berbasis sistem informasi')">
                                [PLO 02] Mampu merancang, mengembangkan, mengimplementasikan, dan mengevaluasi solusi
                                berbasis sistem informasi
                            </div>

                            <div class="plo-option"
                                onclick="selectPlo('[PLO 03] Mampu untuk bekerja secara kolaboratif, proaktif, dan bertanggungjawab dalam tim untuk mencapai tujuan bersama')">
                                [PLO 03] Mampu untuk bekerja secara kolaboratif, proaktif, dan bertanggungjawab dalam tim
                                untuk mencapai tujuan bersama
                            </div>

                            <div class="plo-option"
                                onclick="selectPlo('[PLO 04] Mampu menerapkan pemikiran logis, kritis, sistematis, inovatif terhadap isu dan tanggung jawab profesional')">
                                [PLO 04] Mampu menerapkan pemikiran logis, kritis, sistematis, inovatif terhadap isu dan
                                tanggung jawab profesional
                            </div>

                            <div class="plo-option"
                                onclick="selectPlo('[PLO 05] Mampu untuk bekerja secara kolaboratif, proaktif, dan bertanggungjawab dalam tim')">
                                [PLO 05] Mampu untuk bekerja secara kolaboratif, proaktif, dan bertanggungjawab dalam tim
                            </div>

                            <div class="plo-option"
                                onclick="selectPlo('[PLO 06] Mampu menganalisis peran dan dampak dari sistem dan teknologi informasi terhadap pembangunan berkelanjutan')">
                                [PLO 06] Mampu menganalisis peran dan dampak dari sistem dan teknologi informasi terhadap
                                pembangunan berkelanjutan
                            </div>

                            <div class="plo-option"
                                onclick="selectPlo('[PLO 07] Mampu menganalisis peran dan dampak dari sistem dan teknologi informasi')">
                                [PLO 07] Mampu menganalisis peran dan dampak dari sistem dan teknologi informasi
                            </div>

                            <div class="plo-option"
                                onclick="selectPlo('[PLO 08] Mampu menganalisis peran dan dampak dari sistem dan teknologi informasi')">
                                [PLO 08] Mampu menganalisis peran dan dampak dari sistem dan teknologi informasi
                            </div>

                            <div class="plo-option"
                                onclick="selectPlo('[PLO 09] Mampu menganalisis peran dan dampak dari sistem dan teknologi informasi')">
                                [PLO 09] Mampu menganalisis peran dan dampak dari sistem dan teknologi informasi
                            </div>

                            <div class="plo-option"
                                onclick="selectPlo('[PLO 10] Mampu menganalisis peran dan dampak dari sistem dan teknologi informasi')">
                                [PLO 10] Mampu menganalisis peran dan dampak dari sistem dan teknologi informasi
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer-custom">
                <button type="button" class="btn-cancel" onclick="closeAddPloModal()">Cancel</button>
                <button type="button" class="btn-save">Save</button>
            </div>

        </div>
    </div>

    <script>
        function openAddPloModal() {
            document.getElementById('addPloModal').classList.add('show');
        }

        function closeAddPloModal() {
            document.getElementById('addPloModal').classList.remove('show');
        }
    </script>

    <script>
        function showSelectPlo() {
            document.getElementById('selectPloBox').classList.remove('d-none');
            document.getElementById('addNewPloBox').classList.add('d-none');

            document.querySelector('.tab-select').classList.add('active');
            document.querySelector('.tab-new').classList.remove('active');
        }

        function showAddNewPlo() {
            document.getElementById('addNewPloBox').classList.remove('d-none');
            document.getElementById('selectPloBox').classList.add('d-none');

            document.querySelector('.tab-new').classList.add('active');
            document.querySelector('.tab-select').classList.remove('active');
        }
    </script>

    <script>
        function togglePloList() {
            document.getElementById('ploDropdownList').classList.toggle('show');
        }

        function selectPlo(value) {
            document.getElementById('ploSearchInput').value = value;
            document.getElementById('ploDropdownList').classList.remove('show');
        }
    </script>

    <!-- add pop up edit di manage PLO -->
    <div id="editPloModal" class="modal-overlay">
        <div class="edit-plo-modal">

            <div class="modal-header-custom">
                <h3>Edit PLO</h3>
                <button type="button" onclick="closeEditPloModal()">×</button>
            </div>

            <div class="edit-plo-body">

                <div class="edit-plo-row">
                    <label for="editFakultas">Fakultas</label>
                    <select id="editFakultas" name="fakultas">
                        <option value="Fakultas Rekayasa Industri">Fakultas Rekayasa Industri</option>
                    </select>
                </div>

                <div class="edit-plo-row">
                    <label for="editProdi">Program Studi</label>
                    <select id="editProdi" name="program_studi">
                        <option value="S1 Sistem Informasi">S1 Sistem Informasi</option>
                    </select>
                </div>

                <div class="edit-plo-row">
                    <label for="editKurikulum">Tahun Kurikulum</label>
                    <select id="editKurikulum" name="tahun_kurikulum">
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                    </select>
                </div>

                <div class="edit-plo-row">
                    <label for="editNomorPlo">Nomor PLO</label>
                    <input type="text" id="editNomorPlo" name="nomor_plo" readonly>
                </div>

                <div class="edit-plo-row textarea-row">
                    <label for="editDeskripsiPlo">Deskripsi PLO</label>
                    <textarea id="editDeskripsiPlo" name="deskripsi_plo"></textarea>
                </div>

                <div class="edit-plo-row">
                    <label for="editStatusMapping">Status Aktif PLO Mapping</label>
                    <label class="switch">
                        <input type="checkbox" id="editStatusMapping" name="status_mapping">
                        <span class="slider"></span>
                    </label>
                </div>

                <div class="edit-plo-row">
                    <label for="editStatusPlo">Status Aktif PLO</label>
                    <label class="switch">
                        <input type="checkbox" id="editStatusPlo" name="status_plo">
                        <span class="slider"></span>
                    </label>
                </div>

            </div>

            <div class="modal-footer-custom">
                <button type="button" class="btn-cancel" onclick="closeEditPloModal()">Cancel</button>
                <button type="button" class="btn-save">Save</button>
            </div>

        </div>
    </div>

    <script>
        function openEditPloModal(button) {
            const modal = document.getElementById('editPloModal');

            document.getElementById('editFakultas').value = button.dataset.fakultas || 'Fakultas Rekayasa Industri';
            document.getElementById('editProdi').value = button.dataset.prodi || 'S1 Sistem Informasi';
            document.getElementById('editKurikulum').value = button.dataset.kurikulum || '2024';
            document.getElementById('editNomorPlo').value = button.dataset.nomor || '1';
            document.getElementById('editDeskripsiPlo').value = button.dataset.deskripsi || '';
            document.getElementById('editStatusMapping').checked = (button.dataset.statusMapping === 'Active');
            document.getElementById('editStatusPlo').checked = (button.dataset.statusPlo === 'Active');

            modal.classList.add('show');
        }

        function closeEditPloModal() {
            document.getElementById('editPloModal').classList.remove('show');
        }
    </script>
@endsection
