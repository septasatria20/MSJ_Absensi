@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav')
    
    <div class="container-fluid py-2">
        {{-- TABS NAVIGATION --}}
        <ul class="nav nav-tabs mb-2" id="tukarJadwalTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="history-tab" data-bs-toggle="tab" data-bs-target="#history" 
                        type="button" role="tab">
                    <i class="fas fa-history me-2"></i>History Tukar Jadwal
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="form-tab" data-bs-toggle="tab" data-bs-target="#form" 
                        type="button" role="tab">
                    <i class="fas fa-plus-circle me-2"></i>Pengajuan Baru
                </button>
            </li>
        </ul>

        {{-- TAB CONTENT --}}
        <div class="tab-content" id="tukarJadwalTabContent">
            
            {{-- HISTORY TAB --}}
            <div class="tab-pane fade show active" id="history" role="tabpanel">
                <div class="card shadow-sm mb-3">
                    <div class="card-body p-3">
                        <div class="mb-2">
                            <h6 class="mb-0 text-dark font-weight-bold">History Tukar Jadwal</h6>
                        </div>
                        <div class="row g-3 align-items-end">
                            <div class="col-md-3">
                                <label for="historyPengajuFilter" class="form-label text-sm font-weight-bold">Karyawan Pengaju</label>
                                <input type="text" class="form-control" id="historyPengajuFilter" placeholder="Cari pengaju...">
                            </div>
                            <div class="col-md-3">
                                <label for="historyDitukarFilter" class="form-label text-sm font-weight-bold">Karyawan Ditukar</label>
                                <input type="text" class="form-control" id="historyDitukarFilter" placeholder="Cari karyawan ditukar...">
                            </div>
                            <div class="col-md-2">
                                <label for="historyStatusFilter" class="form-label text-sm font-weight-bold">Status</label>
                                <select class="form-select" id="historyStatusFilter">
                                    <option value="">-- Semua Status --</option>
                                    <option value="approved">Approved</option>
                                    <option value="pending">Pending</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex gap-2 flex-wrap">
                                    <button class="btn btn-primary" type="button" onclick="showFormTab()">
                                        <i class="fas fa-plus me-1"></i>Tambah
                                    </button>
                                    <button class="btn btn-primary" type="button" onclick="applyHistoryFilter()">
                                        <i class="fas fa-search me-1"></i>Terapkan
                                    </button>
                                    <button class="btn btn-secondary" type="button" onclick="resetHistoryFilter()">
                                        <i class="fas fa-rotate-left me-1"></i>Reset
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-items-center mb-0" id="historyTable">
                                <thead class="thead-light" style="background-color: #00b7bd4f;">
                                    <tr>
                                        <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">No</th>
                                        <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">Tanggal Pengajuan</th>
                                        <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">Karyawan Pengaju</th>
                                        <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">Departemen</th>
                                        <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">Shift Asal</th>
                                        <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">Karyawan Ditukar</th>
                                        <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">Departemen</th>
                                        <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">Shift Tujuan</th>
                                        <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">Tanggal Tukar</th>
                                        <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">Status</th>
                                        <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="historyTableBody">
                                    <tr>
                                        <td colspan="11" class="text-center py-5">
                                            <div class="spinner-border text-primary" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            <p class="text-sm text-secondary mt-3">Memuat history...</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- FORM TAB --}}
            <div class="tab-pane fade" id="form" role="tabpanel">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="mb-2">
                            <h6 class="mb-0 text-dark font-weight-bold">Pengajuan Tukar Jadwal</h6>
                            <p class="text-sm mb-0 text-secondary">Form pengajuan tukar jadwal antar karyawan</p>
                        </div>
                        <form id="tukarJadwalForm" onsubmit="submitTukarJadwal(event)">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label for="tanggal_tukar" class="form-label text-sm font-weight-bold">
                                        Tanggal Tukar Jadwal <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" class="form-control" id="tanggal_tukar" name="tanggal_tukar" required>
                                </div>
                            </div>

                            <div class="row">
                                {{-- KARYAWAN PENGAJU --}}
                                <div class="col-md-5">
                                    <div class="mb-3 position-relative">
                                        <label for="karyawan_pengaju" class="form-label text-sm font-weight-bold">
                                            Karyawan Pengaju <span class="text-danger">*</span>
                                        </label>
                                        <input type="hidden" id="nik_pengaju" name="nik_pengaju">
                                        <input type="text" class="form-control" id="karyawan_pengaju" 
                                               placeholder="Cari NIK atau Nama..." autocomplete="off" required>
                                        <div id="karyawanPengajuDropdown" class="autocomplete-dropdown"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-sm font-weight-bold">Shift Saat Ini</label>
                                        <input type="text" class="form-control bg-light" id="shift_pengaju" readonly 
                                               placeholder="Pilih karyawan terlebih dahulu">
                                    </div>
                                </div>

                                {{-- ICON TUKAR --}}
                                <div class="col-md-2 d-flex align-items-center justify-content-center">
                                    <div class="text-center" style="margin-top: 20px;">
                                        <i class="fas fa-exchange-alt fa-3x text-primary"></i>
                                    </div>
                                </div>

                                {{-- KARYAWAN DITUKAR --}}
                                <div class="col-md-5">
                                    <div class="mb-3 position-relative">
                                        <label for="karyawan_ditukar" class="form-label text-sm font-weight-bold">
                                            Karyawan Ditukar <span class="text-danger">*</span>
                                        </label>
                                        <input type="hidden" id="nik_ditukar" name="nik_ditukar">
                                        <input type="text" class="form-control" id="karyawan_ditukar" 
                                               placeholder="Cari NIK atau Nama..." autocomplete="off" required>
                                        <div id="karyawanDitukarDropdown" class="autocomplete-dropdown"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-sm font-weight-bold">Shift Tujuan</label>
                                        <input type="text" class="form-control bg-light" id="shift_ditukar" readonly 
                                               placeholder="Pilih karyawan terlebih dahulu">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="alasan" class="form-label text-sm font-weight-bold">
                                            Alasan Tukar Jadwal <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control" id="alasan" name="alasan" rows="3" 
                                                  placeholder="Ada keperluan keluarga mendadak" required></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="catatan_admin" class="form-label text-sm font-weight-bold">
                                            Catatan Admin
                                        </label>
                                        <textarea class="form-control" id="catatan_admin" name="catatan_admin" rows="2" 
                                                  placeholder="Catatan dari admin atau approver..."></textarea>
                                        <small class="text-muted"></small>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <button type="button" class="btn btn-secondary" onclick="resetForm()">
                                            <i class="fas fa-redo me-2"></i>Reset
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-paper-plane me-2"></i>Simpan Pengajuan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- MODAL DETAIL --}}
    <div class="modal fade" id="detailModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Tukar Jadwal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="text-sm mb-1 text-secondary">Tanggal Pengajuan</p>
                            <p class="font-weight-bold" id="detail_tanggal_pengajuan">-</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-sm mb-1 text-secondary">Tanggal Tukar</p>
                            <p class="font-weight-bold" id="detail_tanggal_tukar">-</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6 class="text-primary">Karyawan Pengaju</h6>
                            <p class="text-sm mb-1 text-secondary">NIK</p>
                            <p class="font-weight-bold" id="detail_nik_pengaju">-</p>
                            <p class="text-sm mb-1 text-secondary">Nama</p>
                            <p class="font-weight-bold" id="detail_nama_pengaju">-</p>
                            <p class="text-sm mb-1 text-secondary">Departemen</p>
                            <p class="font-weight-bold" id="detail_dept_pengaju">-</p>
                            <p class="text-sm mb-1 text-secondary">Shift Asal</p>
                            <p class="font-weight-bold" id="detail_shift_asal">-</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-primary">Karyawan Ditukar</h6>
                            <p class="text-sm mb-1 text-secondary">NIK</p>
                            <p class="font-weight-bold" id="detail_nik_ditukar">-</p>
                            <p class="text-sm mb-1 text-secondary">Nama</p>
                            <p class="font-weight-bold" id="detail_nama_ditukar">-</p>
                            <p class="text-sm mb-1 text-secondary">Departemen</p>
                            <p class="font-weight-bold" id="detail_dept_ditukar">-</p>
                            <p class="text-sm mb-1 text-secondary">Shift Tujuan</p>
                            <p class="font-weight-bold" id="detail_shift_tujuan">-</p>
                        </div>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <p class="text-sm mb-1 text-secondary">Alasan</p>
                        <p id="detail_alasan">-</p>
                    </div>
                    <div class="mb-3">
                        <p class="text-sm mb-1 text-secondary">Catatan Admin</p>
                        <p id="detail_catatan_admin" class="text-muted">-</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    {{-- JAVASCRIPT --}}
    @push('js')
    <style>
        .autocomplete-dropdown {
            position: absolute;
            background: white;
            border: 1px solid #ddd;
            border-radius: 4px;
            max-height: 200px;
            overflow-y: auto;
            width: 100%;
            z-index: 1000;
            display: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .autocomplete-item {
            padding: 8px 12px;
            cursor: pointer;
            font-size: 0.875rem;
            border-bottom: 1px solid #f0f0f0;
        }
        .autocomplete-item:last-child {
            border-bottom: none;
        }
        .autocomplete-item:hover {
            background: #f8f9fa;
        }
        .autocomplete-item strong {
            color: #5e72e4;
        }
        .autocomplete-item small {
            color: #8898aa;
        }
        .nav-tabs .nav-link {
            color: #8898aa;
        }
        .nav-tabs .nav-link.active {
            color: #5e72e4;
            font-weight: 600;
        }
        #historyTable th,
        #historyTable td {
            text-align: left;
            vertical-align: middle;
            border: 1px solid #e9ecef;
            padding: 7px;
            white-space: nowrap;
        }
        #historyTable td small {
            display: block;
            font-size: 11px;
            color: #67748e;
            margin-top: 2px;
        }
        .dt-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 16px;
            padding: 16px 16px 0;
        }
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_length {
            display: none;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            border: 1px solid #028284 !important;
            background: linear-gradient(135deg, #028284, #025f60) !important;
            color: white !important;
        }
    </style>
    <script>
        let historyTable = null;
        let karyawanList = [];

        $(document).ready(function() {
            loadHistory();
            loadKaryawanList();
            setupAutocomplete();
            document.getElementById('tanggal_tukar').valueAsDate = new Date();
        });

        function styleMsjButtons() {
            $('.dt-button').addClass('btn btn-secondary');
            $('.dt-button').removeClass('dt-button');
        }

        function loadKaryawanList() {
            $.ajax({
                url: '{{ url("/trstuk/getkaryawan") }}',
                method: 'GET',
                data: { query: '' },
                success: function(response) {
                    if (response.success) {
                        karyawanList = response.data;
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal memuat data karyawan.',
                        confirmButtonColor: '#028284'
                    });
                }
            });
        }

        function setupAutocomplete() {
            setupAutocompleteField('karyawan_pengaju', 'karyawanPengajuDropdown', function(karyawan) {
                document.getElementById('nik_pengaju').value = karyawan.nik;
                document.getElementById('karyawan_pengaju').value = `${karyawan.nik} - ${karyawan.nama}`;
                document.getElementById('shift_pengaju').value = karyawan.shift_desc;
                document.getElementById('karyawanPengajuDropdown').style.display = 'none';
            });

            setupAutocompleteField('karyawan_ditukar', 'karyawanDitukarDropdown', function(karyawan) {
                document.getElementById('nik_ditukar').value = karyawan.nik;
                document.getElementById('karyawan_ditukar').value = `${karyawan.nik} - ${karyawan.nama}`;
                document.getElementById('shift_ditukar').value = karyawan.shift_desc;
                document.getElementById('karyawanDitukarDropdown').style.display = 'none';
            });
        }

        function setupAutocompleteField(inputId, dropdownId, onSelectCallback) {
            const input = document.getElementById(inputId);
            const dropdown = document.getElementById(dropdownId);

            input.addEventListener('input', function() {
                const query = this.value.toLowerCase().trim();
                if (query.length === 0) {
                    dropdown.style.display = 'none';
                    return;
                }

                const filtered = karyawanList.filter(k =>
                    k.nik.includes(query) || k.nama.toLowerCase().includes(query)
                );

                if (filtered.length > 0) {
                    dropdown.innerHTML = '';
                    filtered.forEach(k => {
                        const item = document.createElement('div');
                        item.className = 'autocomplete-item';
                        item.innerHTML = `
                            <strong>${k.nik}</strong> - ${k.nama}
                            <br><small>${k.departemen} | ${k.shift_desc}</small>
                        `;
                        item.addEventListener('click', function() {
                            onSelectCallback(k);
                            dropdown.style.display = 'none';
                        });
                        dropdown.appendChild(item);
                    });
                    dropdown.style.display = 'block';
                } else {
                    dropdown.innerHTML = '<div class="autocomplete-item">Tidak ada hasil</div>';
                    dropdown.style.display = 'block';
                }
            });

            document.addEventListener('click', function(e) {
                if (e.target !== input && !dropdown.contains(e.target)) {
                    dropdown.style.display = 'none';
                }
            });
        }

        function loadHistory() {
            $.ajax({
                url: '{{ url("/trstuk/ajax") }}',
                method: 'GET',
                data: {
                    all: 1,
                    search_pengaju: document.getElementById('historyPengajuFilter').value.trim(),
                    search_ditukar: document.getElementById('historyDitukarFilter').value.trim(),
                    status: document.getElementById('historyStatusFilter').value
                },
                success: function(response) {
                    if (response.success) {
                        renderHistoryTable(response.data);
                    }
                },
                error: function() {
                    document.getElementById('historyTableBody').innerHTML = `
                        <tr>
                            <td colspan="11" class="text-center py-5 text-danger">
                                <i class="fas fa-exclamation-triangle fa-2x mb-3 d-block"></i>
                                <p>Error loading data</p>
                            </td>
                        </tr>
                    `;
                }
            });
        }

        function renderHistoryTable(data) {
            if (historyTable) {
                historyTable.destroy();
            }

            if (data.length === 0) {
                document.getElementById('historyTableBody').innerHTML = `
                    <tr>
                        <td colspan="11" class="text-center py-5">
                            <i class="fas fa-inbox fa-3x text-secondary mb-3 d-block"></i>
                            <p class="text-sm text-secondary">Tidak ada history tukar jadwal</p>
                        </td>
                    </tr>
                `;
                return;
            }

            let html = '';
            data.forEach((row, index) => {
                const statusLabel = row.status.charAt(0).toUpperCase() + row.status.slice(1);
                html += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${formatDate(row.tanggal_pengajuan)}</td>
                        <td><strong>${row.nik_pengaju}</strong><br><small>${row.nama_pengaju}</small></td>
                        <td>${row.departemen_pengaju}</td>
                        <td>${row.shift_asal_desc}</td>
                        <td><strong>${row.nik_ditukar}</strong><br><small>${row.nama_ditukar}</small></td>
                        <td>${row.departemen_ditukar}</td>
                        <td>${row.shift_tujuan_desc}</td>
                        <td>${formatDate(row.tanggal_tukar)}</td>
                        <td>${statusLabel}</td>
                        <td>
                            <button class="btn btn-sm btn-info" onclick='showDetail(${JSON.stringify(row)})'>
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                `;
            });
            document.getElementById('historyTableBody').innerHTML = html;

            historyTable = $('#historyTable').DataTable({
                language: {
                    lengthMenu: 'Tampilkan _MENU_ baris',
                    zeroRecords: 'Maaf - Data tidak ada',
                    info: 'Data _START_ - _END_ dari _TOTAL_',
                    infoEmpty: 'Tidak ada data',
                    infoFiltered: '(pencarian dari _MAX_ data)'
                },
                searching: false,
                responsive: true,
                order: [[1, 'desc']],
                dom: 'Brtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel me-1 text-lg text-success"></i><span class="font-weight-bold"> Excel',
                        autoFilter: true,
                        sheetName: 'History Tukar Jadwal',
                        exportOptions: { columns: ':visible' }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf me-1 text-lg text-danger"></i><span class="font-weight-bold"> PDF',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        exportOptions: { columns: ':visible' }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print me-1 text-lg text-info"></i><span class="font-weight-bold"> Print',
                        exportOptions: { columns: ':visible' }
                    }
                ]
            });

            styleMsjButtons();
        }

        function applyHistoryFilter() {
            loadHistory();
        }

        function resetHistoryFilter() {
            document.getElementById('historyPengajuFilter').value = '';
            document.getElementById('historyDitukarFilter').value = '';
            document.getElementById('historyStatusFilter').value = '';
            loadHistory();
        }

        function showDetail(row) {
            document.getElementById('detail_tanggal_pengajuan').textContent = formatDate(row.tanggal_pengajuan);
            document.getElementById('detail_tanggal_tukar').textContent = formatDate(row.tanggal_tukar);
            document.getElementById('detail_nik_pengaju').textContent = row.nik_pengaju;
            document.getElementById('detail_nama_pengaju').textContent = row.nama_pengaju;
            document.getElementById('detail_dept_pengaju').textContent = row.departemen_pengaju;
            document.getElementById('detail_shift_asal').textContent = row.shift_asal_desc;
            document.getElementById('detail_nik_ditukar').textContent = row.nik_ditukar;
            document.getElementById('detail_nama_ditukar').textContent = row.nama_ditukar;
            document.getElementById('detail_dept_ditukar').textContent = row.departemen_ditukar;
            document.getElementById('detail_shift_tujuan').textContent = row.shift_tujuan_desc;
            document.getElementById('detail_alasan').textContent = row.alasan;
            document.getElementById('detail_catatan_admin').textContent = row.catatan_admin || 'Belum ada catatan';
            new bootstrap.Modal(document.getElementById('detailModal')).show();
        }

        function submitTukarJadwal(event) {
            event.preventDefault();

            const formData = {
                tanggal_tukar: document.getElementById('tanggal_tukar').value,
                nik_pengaju: document.getElementById('nik_pengaju').value,
                nik_ditukar: document.getElementById('nik_ditukar').value,
                alasan: document.getElementById('alasan').value,
                catatan_admin: document.getElementById('catatan_admin').value,
                _token: '{{ csrf_token() }}'
            };

            if (!formData.nik_pengaju || !formData.nik_ditukar) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Silakan pilih karyawan pengaju dan karyawan ditukar',
                    confirmButtonColor: '#5e72e4'
                });
                return;
            }

            if (formData.nik_pengaju === formData.nik_ditukar) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Karyawan pengaju dan ditukar tidak boleh sama',
                    confirmButtonColor: '#5e72e4'
                });
                return;
            }

            $.ajax({
                url: '{{ url("/trstuk/store") }}',
                method: 'POST',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                            confirmButtonColor: '#5e72e4'
                        }).then(() => {
                            resetForm();
                            bootstrap.Tab.getInstance(document.getElementById('history-tab')).show();
                            loadHistory();
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal menyimpan pengajuan. Silakan coba lagi.',
                        confirmButtonColor: '#5e72e4'
                    });
                }
            });
        }

        function resetForm() {
            document.getElementById('tukarJadwalForm').reset();
            document.getElementById('nik_pengaju').value = '';
            document.getElementById('nik_ditukar').value = '';
            document.getElementById('shift_pengaju').value = '';
            document.getElementById('shift_ditukar').value = '';
            document.getElementById('shift_pengaju').placeholder = 'Pilih karyawan terlebih dahulu';
            document.getElementById('shift_ditukar').placeholder = 'Pilih karyawan terlebih dahulu';
            document.getElementById('tanggal_tukar').valueAsDate = new Date();
        }

        function formatDate(dateStr) {
            if (!dateStr) return '-';
            const date = new Date(dateStr);
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }

        function showFormTab() {
            const formTab = document.getElementById('form-tab');
            const formTabPane = new bootstrap.Tab(formTab);
            formTabPane.show();
        }
    </script>
    @endpush
@endsection
