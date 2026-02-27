@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav')
    
    <div class="container-fluid py-4">
        {{-- PAGE HEADER --}}
        <div class="card shadow-sm mb-4">
            <div class="card-body p-3">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0 text-dark font-weight-bold">History Tukar Jadwal</h6>
                        <p class="text-sm mb-0 text-secondary">Pengajuan dan History Tukar Jadwal Shift Karyawan</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- TABS NAVIGATION --}}
        <ul class="nav nav-tabs mb-3" id="tukarJadwalTabs" role="tablist">
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
                {{-- FILTER & ACTIONS --}}
                <div class="card shadow-sm mb-3">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex gap-2">
                                <button class="btn btn-sm btn-primary" onclick="showFormTab()">
                                    <i class="fas fa-plus me-1"></i>Tambah
                                </button>
                                <button class="btn btn-sm btn-success" onclick="exportExcel()">
                                    <i class="fas fa-file-excel me-1"></i>Excel
                                </button>
                                <button class="btn btn-sm btn-danger" onclick="exportPDF()">
                                    <i class="fas fa-file-pdf me-1"></i>PDF
                                </button>
                                <button class="btn btn-sm btn-secondary" onclick="printTable()">
                                    <i class="fas fa-print me-1"></i>Print
                                </button>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <label class="text-sm mb-0">Cari :</label>
                                <input type="text" class="form-control form-control-sm" id="searchInput" 
                                       placeholder="Cari karyawan..." style="width: 250px;" 
                                       onkeyup="searchHistory()">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- HISTORY TABLE --}}
                <div class="card shadow-sm">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NO</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TANGGAL PENGAJUAN</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">KARYAWAN PENGAJU</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">DEPARTEMEN</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">SHIFT ASAL</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">KARYAWAN DITUKAR</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">DEPARTEMEN</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">SHIFT TUJUAN</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TANGGAL TUKAR</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody id="historyTableBody">
                                    <tr>
                                        <td colspan="10" class="text-center py-5">
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
                    {{-- PAGINATION --}}
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <div class="text-sm text-secondary" id="paginationInfo">
                            Menampilkan 0 dari 0 data
                        </div>
                        <div id="paginationControls">
                            {{-- Pagination buttons will be inserted here --}}
                        </div>
                    </div>
                </div>
            </div>

            {{-- FORM TAB --}}
            <div class="tab-pane fade" id="form" role="tabpanel">
                <div class="card shadow-sm">
                    <div class="card-body">
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
    </style>
    <script>
        let currentPage = 1;
        let searchQuery = '';
        let karyawanList = [];

        // Initialize
        $(document).ready(function() {
            loadHistory(1);
            loadKaryawanList();
            setupAutocomplete();
            
            // Set default tanggal tukar to today
            document.getElementById('tanggal_tukar').valueAsDate = new Date();
        });

        // Load Karyawan List
        function loadKaryawanList() {
            console.log('Loading karyawan list...');
            $.ajax({
                url: '{{ url("/trstuk/getkaryawan") }}',
                method: 'GET',
                data: { query: '' },
                success: function(response) {
                    console.log('Karyawan response:', response);
                    if (response.success) {
                        karyawanList = response.data;
                        console.log('✓ Loaded ' + karyawanList.length + ' karyawan');
                    } else {
                        console.error('✗ Failed to load karyawan: Invalid response');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('✗ AJAX Error loading karyawan:', {
                        status: status,
                        error: error,
                        response: xhr.responseText
                    });
                    alert('Gagal memuat data karyawan. Silakan refresh halaman atau hubungi admin.');
                }
            });
        }

        // Setup Autocomplete for both fields
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

                console.log('Searching for:', query, '| Total karyawan:', karyawanList.length);

                // Filter karyawan
                const filtered = karyawanList.filter(k => 
                    k.nik.includes(query) || 
                    k.nama.toLowerCase().includes(query)
                );

                console.log('Found:', filtered.length, 'results');

                if (filtered.length > 0) {
                    dropdown.innerHTML = '';
                    filtered.forEach(k => {
                        const item = document.createElement('div');
                        item.className = 'autocomplete-item';
                        item.innerHTML = `
                            <strong>${k.nik}</strong> - ${k.nama}
                            <br><small>${k.departemen} | ${k.shift_desc}</small>
                        `;
                        
                        // Add click event listener
                        item.addEventListener('click', function() {
                            onSelectCallback(k);
                            dropdown.style.display = 'none';
                        });
                        
                        dropdown.appendChild(item);
                    });
                    dropdown.style.display = 'block';
                } else {
                    if (karyawanList.length === 0) {
                        dropdown.innerHTML = '<div class="autocomplete-item text-danger">Data karyawan belum dimuat. Silakan refresh halaman.</div>';
                    } else {
                        dropdown.innerHTML = '<div class="autocomplete-item">Tidak ada hasil</div>';
                    }
                    dropdown.style.display = 'block';
                }
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (e.target !== input && !dropdown.contains(e.target)) {
                    dropdown.style.display = 'none';
                }
            });
        }

        function selectKaryawan(karyawan, dropdownId, callback) {
            callback(karyawan);
        }

        // Load History
        function loadHistory(page = 1) {
            currentPage = page;
            
            $.ajax({
                url: '{{ url("/trstuk/ajax") }}',
                method: 'GET',
                data: {
                    page: page,
                    search: searchQuery
                },
                success: function(response) {
                    if (response.success) {
                        renderHistoryTable(response.data);
                        renderPagination(response.pagination);
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

        // Render History Table
        function renderHistoryTable(data) {
            if (data.length === 0) {
                document.getElementById('historyTableBody').innerHTML = `
                    <tr>
                        <td colspan="10" class="text-center py-5">
                            <i class="fas fa-inbox fa-3x text-secondary mb-3 d-block"></i>
                            <p class="text-sm text-secondary">Tidak ada history tukar jadwal</p>
                        </td>
                    </tr>
                `;
                return;
            }

            let html = '';
            const offset = (currentPage - 1) * 10;
            
            data.forEach((row, index) => {
                html += `
                    <tr>
                        <td class="text-center text-xs">${offset + index + 1}</td>
                        <td class="text-center text-xs">${formatDate(row.tanggal_pengajuan)}</td>
                        <td class="text-xs ps-2">
                            <strong>${row.nik_pengaju}</strong><br>
                            ${row.nama_pengaju}
                        </td>
                        <td class="text-center text-xs">${row.departemen_pengaju}</td>
                        <td class="text-center text-xs">${row.shift_asal_desc}</td>
                        <td class="text-xs ps-2">
                            <strong>${row.nik_ditukar}</strong><br>
                            ${row.nama_ditukar}
                        </td>
                        <td class="text-center text-xs">${row.departemen_ditukar}</td>
                        <td class="text-center text-xs">${row.shift_tujuan_desc}</td>
                        <td class="text-center text-xs">${formatDate(row.tanggal_tukar)}</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-info" onclick='showDetail(${JSON.stringify(row)})'>
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                `;
            });
            
            document.getElementById('historyTableBody').innerHTML = html;
        }

        // Render Pagination
        function renderPagination(pagination) {
            const { current_page, last_page, per_page, total } = pagination;
            
            // Update info text
            const start = (current_page - 1) * per_page + 1;
            const end = Math.min(current_page * per_page, total);
            document.getElementById('paginationInfo').textContent = 
                `Menampilkan ${start} - ${end} dari ${total} data`;

            if (last_page <= 1) {
                document.getElementById('paginationControls').innerHTML = '';
                return;
            }

            // Generate pagination buttons
            let html = '<nav><ul class="pagination pagination-sm mb-0">';
            
            // Previous button
            html += `
                <li class="page-item ${current_page === 1 ? 'disabled' : ''}">
                    <a class="page-link" href="#" onclick="loadHistory(${current_page - 1}); return false;">
                        <i class="fas fa-angle-left"></i> Previous
                    </a>
                </li>
            `;

            // Page numbers logic - show first, last, current and 2 pages around current
            let pages = [];
            
            // Always show first page
            pages.push(1);
            
            // Show pages around current page
            for (let i = Math.max(2, current_page - 1); i <= Math.min(last_page - 1, current_page + 1); i++) {
                if (!pages.includes(i)) {
                    pages.push(i);
                }
            }
            
            // Always show last page
            if (last_page > 1 && !pages.includes(last_page)) {
                pages.push(last_page);
            }
            
            // Sort pages
            pages.sort((a, b) => a - b);
            
            // Build page buttons with ellipsis
            let prevPage = 0;
            pages.forEach(pageNum => {
                // Add ellipsis if gap
                if (pageNum - prevPage > 1) {
                    html += '<li class="page-item disabled"><span class="page-link">...</span></li>';
                }
                
                html += `
                    <li class="page-item ${pageNum === current_page ? 'active' : ''}">
                        <a class="page-link" href="#" onclick="loadHistory(${pageNum}); return false;">${pageNum}</a>
                    </li>
                `;
                
                prevPage = pageNum;
            });

            // Next button
            html += `
                <li class="page-item ${current_page === last_page ? 'disabled' : ''}">
                    <a class="page-link" href="#" onclick="loadHistory(${current_page + 1}); return false;">
                        Next <i class="fas fa-angle-right"></i>
                    </a>
                </li>
            `;
            
            html += '</ul></nav>';
            document.getElementById('paginationControls').innerHTML = html;
        }

        // Search History
        function searchHistory() {
            searchQuery = document.getElementById('searchInput').value;
            loadHistory(1);
        }

        // Show Detail Modal
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

        // Submit Tukar Jadwal
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

            // Validation
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
                            // Switch to history tab
                            bootstrap.Tab.getInstance(document.getElementById('history-tab')).show();
                            loadHistory(1);
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

        // Reset Form
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

        // Format Date
        function formatDate(dateStr) {
            if (!dateStr) return '-';
            const date = new Date(dateStr);
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }

        // Export Functions (Placeholder)
        function exportExcel() {
            Swal.fire({
                icon: 'info',
                title: 'Export Excel',
                text: 'Fitur export Excel akan segera tersedia',
                confirmButtonColor: '#5e72e4'
            });
        }

        function exportPDF() {
            Swal.fire({
                icon: 'info',
                title: 'Export PDF',
                text: 'Fitur export PDF akan segera tersedia',
                confirmButtonColor: '#5e72e4'
            });
        }

        function printTable() {
            window.print();
        }

        // Show Form Tab
        function showFormTab() {
            const formTab = document.getElementById('form-tab');
            const formTabPane = new bootstrap.Tab(formTab);
            formTabPane.show();
        }
    </script>
    @endpush
@endsection
