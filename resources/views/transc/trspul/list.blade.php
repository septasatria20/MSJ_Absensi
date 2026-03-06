@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav')
    
    <div class="container-fluid py-4">
        {{-- PAGE HEADER --}}
        <div class="card shadow-sm mb-4">
            <div class="card-body p-3">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-1 text-dark font-weight-bold">Pull Finger</h6>
                        <p class="text-sm mb-0 text-secondary">Tarik Data Absensi dari Fingerprint Device - Pilih Filter Bulan untuk Melihat Ringkasan Harian</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- FILTER SECTION - SUMMARY VIEW --}}
        <div class="card shadow-sm mb-4" id="summaryFilterCard">
            <div class="card-body">
                <h6 class="text-dark font-weight-bold mb-3">
                    <i class="fas fa-filter me-2"></i>Filter Ringkasan Harian
                </h6>
                <form id="summaryFilterForm" method="GET">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="tanggal" class="form-label text-sm font-weight-bold">Tanggal</label>
                            <select class="form-select" id="tanggal" name="tanggal">
                                <option value="">-- Semua Tanggal --</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="bulan" class="form-label text-sm font-weight-bold">Bulan</label>
                            <select class="form-select" id="bulan" name="bulan">
                                <option value="">-- Semua Bulan --</option>
                                <option value="2026-01">Januari 2026</option>
                                <option value="2026-02" selected>Februari 2026</option>
                                <option value="2026-03">Maret 2026</option>
                                <option value="2026-04">April 2026</option>
                                <option value="2026-05">Mei 2026</option>
                                <option value="2026-06">Juni 2026</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-sm font-weight-bold">&nbsp;</label>
                            <button type="button" class="btn btn-primary w-100 d-block" onclick="pullFingerDataSummary()">
                                <i class="fas fa-search me-2"></i>Tampilkan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- FILTER SECTION - DETAIL VIEW --}}
        <div class="card shadow-sm mb-4" id="detailFilterCard" style="display: none;">
            <div class="card-body">
                <h6 class="text-dark font-weight-bold mb-3">
                    <i class="fas fa-filter me-2"></i>Filter Data Detail
                </h6>
                <form id="detailFilterForm" method="GET">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="departemenDetail" class="form-label text-sm font-weight-bold">Departemen</label>
                            <select class="form-select" id="departemenDetail" name="departemen">
                                <option value="">-- Semua Departemen --</option>
                                <option value="Produksi">Produksi</option>
                                <option value="Warehouse">Warehouse</option>
                                <option value="QC">Quality Control</option>
                                <option value="Admin">Admin</option>
                                <option value="IT">IT</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="karyawanDetail" class="form-label text-sm font-weight-bold">Karyawan</label>
                            <select class="form-select" id="karyawanDetail" name="karyawan">
                                <option value="">-- Semua Karyawan --</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-sm font-weight-bold">&nbsp;</label>
                            <button type="button" class="btn btn-primary w-100 d-block" onclick="applyDetailFilter()">
                                <i class="fas fa-filter me-2"></i>Filter
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- DAILY SUMMARY VIEW --}}
        <div class="card shadow-sm mb-4" id="dailySummaryCard" style="display: none;">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="text-dark font-weight-bold mb-0">
                        <i class="fas fa-calendar-alt me-2"></i>Ringkasan Data Pull Fingerprint - <span id="summaryMonth">Februari 2026</span>
                    </h6>
                </div>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Informasi:</strong> Pilih tanggal untuk melihat detail data fingerprint per hari. Klik tombol "View" untuk melihat detail.
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-items-center mb-0" id="summaryTable">
                        <thead class="thead-light" style="background-color: #00b7bd4f;">
                            <tr>
                                <th class="text-secondary text-sm font-weight-bold opacity-7" style="width: 50px;">No</th>
                                <th class="text-secondary text-sm font-weight-bold opacity-7" style="width: 80px;">Action</th>
                                <th class="text-secondary text-sm font-weight-bold opacity-7" style="width: 150px;">Tanggal</th>
                                <th class="text-secondary text-sm font-weight-bold opacity-7" style="width: 120px;">Hari</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Daily summary rows will be loaded dynamically --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- DETAIL VIEW --}}
        <div id="detailViewSection" style="display: none;">
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                <strong>Informasi:</strong> Data di bawah adalah detail absensi fingerprint untuk tanggal <strong id="selectedDateDisplay">-</strong>. 
                Anda dapat export data ke Excel/PDF menggunakan tombol di bawah tabel.
            </div>

            {{-- TABLE ACTIONS --}}
            <div class="card shadow-sm mb-3">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between gap-2 flex-wrap">
                        <div class="d-flex gap-2 align-items-center flex-wrap">
                            <button class="btn btn-secondary btn-sm" onclick="backToSummary()">
                                <i class="fas fa-arrow-left me-1"></i> Kembali ke Ringkasan
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- DATA TABLE --}}
            <div class="card shadow-sm">
                <div class="card-header pb-0">
                    <h6 class="text-dark font-weight-bold">
                        <i class="fas fa-fingerprint me-2"></i>Data Pull Fingerprint - <span id="detailDateDisplay">-</span>
                    </h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-items-center mb-0" id="detailTable">
                            <thead class="thead-light" style="background-color: #00b7bd4f;">
                                <tr>
                                    <th class="text-center text-secondary text-sm font-weight-bold opacity-7" style="width: 40px;">No</th>
                                    <th class="text-center text-secondary text-sm font-weight-bold opacity-7">Tanggal</th>
                                    <th class="text-center text-secondary text-sm font-weight-bold opacity-7">Shift</th>
                                    <th class="text-center text-secondary text-sm font-weight-bold opacity-7">NIK</th>
                                    <th class="text-secondary text-sm font-weight-bold opacity-7 ps-2">Nama</th>
                                    <th class="text-center text-secondary text-sm font-weight-bold opacity-7">Masuk<br><small>Scan</small></th>
                                    <th class="text-center text-secondary text-sm font-weight-bold opacity-7">Terlambat</th>
                                    <th class="text-center text-secondary text-sm font-weight-bold opacity-7">Keluar<br><small>Scan</small></th>
                                    <th class="text-center text-secondary text-sm font-weight-bold opacity-7">Pulang<br><small>Cepat</small></th>
                                    <th class="text-center text-secondary text-sm font-weight-bold opacity-7">Istirahat 1<br><small>Scan 1</small></th>
                                    <th class="text-center text-secondary text-sm font-weight-bold opacity-7">Istirahat 1<br><small>Scan 2</small></th>
                                    <th class="text-center text-secondary text-sm font-weight-bold opacity-7">Istirahat 2<br><small>Scan 1</small></th>
                                    <th class="text-center text-secondary text-sm font-weight-bold opacity-7">Istirahat 2<br><small>Scan 2</small></th>
                                    <th class="text-center text-secondary text-sm font-weight-bold opacity-7">Durasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Detail data will be loaded via DataTables --}}
                            </tbody>
                        </table>
                    </div>
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
            border: 1px solid #d2d6da;
            border-top: none;
            border-radius: 0 0 8px 8px;
            max-height: 200px;
            overflow-y: auto;
            z-index: 1000;
            width: 100%;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            display: none;
        }
        .autocomplete-item {
            padding: 10px 12px;
            cursor: pointer;
            font-size: 13px;
            border-bottom: 1px solid #f1f3f5;
        }
        .autocomplete-item:hover {
            background: #f8f9fa;
        }
        .autocomplete-item strong {
            color: #028284;
        }
        
        /* Daily Summary Card Styles */
        .daily-card {
            border-left: 4px solid #028284;
            transition: all 0.2s;
            cursor: pointer;
        }
        .daily-card:hover {
            box-shadow: 0 4px 16px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }
        .daily-card-count {
            font-size: 32px;
            font-weight: 700;
            color: #028284;
        }
        
        /* Table alignment fix */
        #summaryTable th,
        #summaryTable td {
            text-align: left;
            vertical-align: middle;
            border: 1px solid #e9ecef;
            padding: 12px;
        }
        #summaryTable th {
            font-size: 13px;
            font-weight: 600;
            color: #67748e;
        }
        #detailTable th,
        #detailTable td {
            text-align: left;
            vertical-align: middle;
            border: 1px solid #e9ecef;
            padding: 10px;
            font-size: 13px;
        }
        #detailTable th {
            font-size: 13px;
            font-weight: 600;
            color: #67748e;
        }
    </style>
    <script>
        // Global Variables
        let selectedKaryawan = null;
        let currentView = 'summary'; // summary, detail
        let currentFilters = {};
        let selectedDate = null;
        let summaryTable = null; // Summary DataTable
        let detailTable = null; // Detail DataTable
        let allDetailData = []; // Store all detail data for filtering
        let currentDateStr = '';
        let currentDateFormatted = '';
        let currentDayName = '';
        let dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        // Dummy data karyawan untuk autocomplete (nanti akan dari AJAX)
        const karyawanData = [
            { nik: '001', nama: 'Ahmad Budiman' },
            { nik: '002', nama: 'Siti Nurhaliza' },
            { nik: '003', nama: 'Budi Santoso' },
            { nik: '004', nama: 'Dewi Kusuma' },
            { nik: '005', nama: 'Eko Prasetyo' },
            { nik: '006', nama: 'Fitri Handayani' },
            { nik: '007', nama: 'Gunawan Wibowo' },
            { nik: '008', nama: 'Hani Rahmawati' },
            { nik: '009', nama: 'Indra Setia' },
            { nik: '010', nama: 'Joko Widodo' },
            { nik: '011', nama: 'Karina Salsabila' }
        ];

        // Initialize on page load
        $(document).ready(function() {
            // Summary will use DataTables (initialized after data load)
            // Detail will use plain table
            
            // Auto-load summary data for February 2026
            pullFingerDataSummary();
        });

        // Note: Autocomplete functions removed - now using dropdown filters for departemen and karyawan in detail view

        // Populate date filter dropdown
        function populateDateFilter(dates) {
            const select = document.getElementById('tanggal');
            select.innerHTML = '<option value="">-- Semua Tanggal --</option>';
            
            if (dates && dates.length > 0) {
                dates.forEach(item => {
                    const date = new Date(item.tanggal_iso);
                    const dayName = dayNames[date.getDay()];
                    const option = document.createElement('option');
                    option.value = item.tanggal_iso;
                    option.textContent = `${item.tanggal} (${dayName})`;
                    select.appendChild(option);
                });
            }
        }

        // Pull Finger Data (Show Daily Summary)
        function pullFingerDataSummary() {
            const tanggal = document.getElementById('tanggal').value;
            const bulan = document.getElementById('bulan').value;
            
            // Store current filters
            currentFilters = {
                tanggal: tanggal,
                bulan: bulan
            };

            // Hide detail view if visible
            document.getElementById('detailViewSection').style.display = 'none';
            document.getElementById('summaryFilterCard').style.display = 'block';
            document.getElementById('detailFilterCard').style.display = 'none';

            // Show daily summary card with loading
            document.getElementById('dailySummaryCard').style.display = 'block';
            
            // Clear and show loading in plain table
            const tbody = $('#summaryTable tbody');
            tbody.empty();
            tbody.append(`
                <tr>
                    <td colspan="4" class="text-center py-4">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="text-sm text-secondary mt-3 mb-0">Memuat ringkasan harian...</p>
                    </td>
                </tr>
            `);

            // AJAX Request to get daily summary
            $.ajax({
                url: '{{ url("/trspul/summary") }}',
                method: 'GET',
                data: {
                    tanggal: tanggal,
                    bulan: bulan
                },
                success: function(response) {
                    console.log('Summary Response:', response);
                    if (response.success && response.data.length > 0) {
                        // Populate date filter dropdown
                        populateDateFilter(response.data);
                        
                        // Render summary table
                        renderDailySummary(response.data);
                        
                        // Update display text
                        let periodText = 'Semua Data';
                        if (bulan) {
                            const bulanNames = {
                                '2026-01': 'Januari 2026',
                                '2026-02': 'Februari 2026',
                                '2026-03': 'Maret 2026',
                                '2026-04': 'April 2026',
                                '2026-05': 'Mei 2026',
                                '2026-06': 'Juni 2026'
                            };
                            periodText = bulanNames[bulan];
                        } else if (tanggal) {
                            const date = new Date(tanggal);
                            const dayName = dayNames[date.getDay()];
                            periodText = `${date.getDate().toString().padStart(2, '0')}/${(date.getMonth() + 1).toString().padStart(2, '0')}/${date.getFullYear()} (${dayName})`;
                        }
                        document.getElementById('summaryMonth').textContent = periodText;
                        
                        currentView = 'summary';
                    } else {
                        // No data - show message in plain table
                        const tbody = $('#summaryTable tbody');
                        tbody.empty();
                        tbody.append(`
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    <i class="fas fa-inbox fa-3x text-secondary mb-3 d-block"></i>
                                    <p class="text-sm text-secondary mb-0">Tidak ada data untuk filter yang dipilih</p>
                                </td>
                            </tr>
                        `);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', xhr, status, error);
                    
                    // Show error message in plain table
                    const tbody = $('#summaryTable tbody');
                    tbody.empty();
                    tbody.append(`
                        <tr>
                            <td colspan="4" class="text-center py-4 text-danger">
                                <i class="fas fa-exclamation-triangle fa-2x mb-3 d-block"></i>
                                <p class="mb-0">Error: ${error}</p>
                            </td>
                        </tr>
                    `);
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal memuat ringkasan. Silakan coba lagi.',
                        confirmButtonColor: '#028284'
                    });
                }
            });
        }

        // Render Daily Summary Table with DataTables
        function renderDailySummary(data) {
            // Destroy existing DataTable if exists
            if (summaryTable) {
                summaryTable.destroy();
            }
            
            const tbody = $('#summaryTable tbody');
            tbody.empty();
            
            // Add rows
            data.forEach((day, index) => {
                const dateObj = new Date(day.tanggal_iso);
                const dayName = dayNames[dateObj.getDay()];
                
                const row = `
                    <tr>
                        <td>${index + 1}</td>
                        <td>
                            <button class="btn btn-sm btn-primary" onclick="showDetailView('${day.tanggal}', '${dayName}')">
                                <i class="fas fa-eye me-1"></i> View
                            </button>
                        </td>
                        <td>${day.tanggal}</td>
                        <td>${dayName}</td>
                    </tr>
                `;
                tbody.append(row);
            });
            
            // Initialize DataTable on summary with MSJ styling (without search box)
            summaryTable = $('#summaryTable').DataTable({
                "language": {
                    "lengthMenu": "Tampilkan _MENU_ baris",
                    "zeroRecords": "Maaf - Data tidak ada",
                    "info": "Data _START_ - _END_ dari _TOTAL_",
                    "infoEmpty": "Tidak ada data",
                    "infoFiltered": "(pencarian dari _MAX_ data)"
                },
                "searching": false, // Disable search box
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel me-1 text-lg text-success"></i><span class="font-weight-bold"> Excel',
                        autoFilter: true,
                        sheetName: 'Ringkasan Harian',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf me-1 text-lg text-danger"></i><span class="font-weight-bold"> PDF',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print me-1 text-lg text-info"></i><span class="font-weight-bold"> Print',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }
                ]
            });
            
            // Style buttons like MSJ framework
            $('.dt-button').addClass('btn btn-secondary');
            $('.dt-button').removeClass('dt-button');
        }

        // Show Detail View for Selected Date with Plain Table
        function showDetailView(tanggal, dayName) {
            selectedDate = tanggal;
            currentDateStr = tanggal;
            currentDateFormatted = tanggal;
            currentDayName = dayName;
            
            // Show/Hide filter cards
            document.getElementById('summaryFilterCard').style.display = 'none';
            document.getElementById('detailFilterCard').style.display = 'block';
            
            // Hide summary, show detail
            document.getElementById('dailySummaryCard').style.display = 'none';
            document.getElementById('detailViewSection').style.display = 'block';
            
            // Reset filters
            document.getElementById('departemenDetail').value = '';
            document.getElementById('karyawanDetail').value = '';
            
            // Update headers - wait for elements to be visible
            setTimeout(() => {
                const selectedDateElem = document.getElementById('selectedDateDisplay');
                const detailDateElem = document.getElementById('detailDateDisplay');
                
                if (selectedDateElem) {
                    selectedDateElem.textContent = `${tanggal} (${dayName})`;
                }
                if (detailDateElem) {
                    detailDateElem.textContent = `${tanggal} (${dayName})`;
                }
            }, 10);
            
            // Clear and show loading in plain table
            const tbody = $('#detailTable tbody');
            tbody.empty();
            tbody.append(`
                <tr>
                    <td colspan="12" class="text-center py-4">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="text-sm text-secondary mt-3 mb-0">Memuat detail data...</p>
                    </td>
                </tr>
            `);
            
            // AJAX Request to get detail data
            $.ajax({
                url: '{{ url("/trspul/detail") }}',
                method: 'GET',
                data: {
                    tanggal: tanggal
                },
                success: function(response) {
                    console.log('Detail Response:', response);
                    if (response.success && response.data.length > 0) {
                        allDetailData = response.data; // Store for filtering
                        
                        // Populate employee dropdown
                        populateEmployeeFilter(response.data);
                        
                        renderDetailTable(response.data);
                        currentView = 'detail';
                    } else {
                        tbody.empty();
                        tbody.append(`
                            <tr>
                                <td colspan="12" class="text-center py-4">
                                    <i class="fas fa-inbox fa-3x text-secondary mb-3 d-block"></i>
                                    <p class="text-sm text-secondary mb-0">Tidak ada data untuk tanggal ini</p>
                                </td>
                            </tr>
                        `);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', xhr, status, error);
                    tbody.empty();
                    tbody.append(`
                        <tr>
                            <td colspan="12" class="text-center py-4 text-danger">
                                <i class="fas fa-exclamation-triangle fa-2x mb-3 d-block"></i>
                                <p class="mb-0">Error: ${error}</p>
                            </td>
                        </tr>
                    `);
                }
            });
        }
        
        // Populate employee filter for detail view
        function populateEmployeeFilter(data) {
            const select = document.getElementById('karyawanDetail');
            select.innerHTML = '<option value="">-- Semua Karyawan --</option>';
            
            const uniqueEmployees = [...new Set(data.map(d => d.nik + ' - ' + d.nama))];
            uniqueEmployees.sort().forEach(emp => {
                const option = document.createElement('option');
                option.value = emp.split(' - ')[0];
                option.textContent = emp;
                select.appendChild(option);
            });
        }
        
        // Filter Detail Data
        function applyDetailFilter() {
            const departemen = document.getElementById('departemenDetail').value;
            const karyawan = document.getElementById('karyawanDetail').value;
            
            let filteredData = [...allDetailData];
            
            if (departemen) {
                filteredData = filteredData.filter(d => d.departemen === departemen);
            }
            if (karyawan) {
                filteredData = filteredData.filter(d => d.nik === karyawan);
            }
            
            renderDetailTable(filteredData);
        }

        // Render Detail Table with DataTables
        function renderDetailTable(data) {
            // Destroy existing DataTable if exists
            if (detailTable) {
                detailTable.destroy();
            }
            
            const tbody = $('#detailTable tbody');
            tbody.empty();
            
            // Add rows to table
            data.forEach((row, index) => {
                const tr = `
                    <tr>
                        <td class="text-center">${index + 1}</td>
                        <td class="text-center">${currentDateFormatted}<br><small class="text-muted">${currentDayName}</small></td>
                        <td class="text-center">${row.shift_code}<br><small class="text-secondary">${row.shift_name}</small></td>
                        <td class="text-center">${row.nik}</td>
                        <td class="ps-2">${row.nama}<br><small class="text-muted">${row.departemen || '-'}</small></td>
                        <td class="text-center">${row.scan_masuk}</td>
                        <td class="text-center">${row.terlambat || '00:00'}</td>
                        <td class="text-center">${row.scan_keluar}</td>
                        <td class="text-center">${row.pulang_cepat || '00:00'}</td>
                        <td class="text-center">${row.istirahat1_scan1 || '-'}</td>
                        <td class="text-center">${row.istirahat1_scan2 || '-'}</td>
                        <td class="text-center">${row.istirahat2_scan1 || '-'}</td>
                        <td class="text-center">${row.istirahat2_scan2 || '-'}</td>
                        <td class="text-center">${row.durasi}</td>
                    </tr>
                `;
                tbody.append(tr);
            });
            
            // Initialize DataTable on detail table
            detailTable = $('#detailTable').DataTable({
                "language": {
                    "lengthMenu": "Tampilkan _MENU_ baris",
                    "zeroRecords": "Maaf - Data tidak ada",
                    "info": "Data _START_ - _END_ dari _TOTAL_",
                    "infoEmpty": "Tidak ada data",
                    "infoFiltered": "(pencarian dari _MAX_ data)"
                },
                "searching": false,
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel me-1 text-lg text-success"></i><span class="font-weight-bold"> Excel',
                        autoFilter: true,
                        sheetName: 'Detail Pull Fingerprint',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf me-1 text-lg text-danger"></i><span class="font-weight-bold"> PDF',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print me-1 text-lg text-info"></i><span class="font-weight-bold"> Print',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }
                ]
            });
            
            // Style buttons like MSJ framework
            $('.dt-button').addClass('btn btn-sm');
            $('.dt-button').removeClass('dt-button');
        }

        // Back to Summary
        function backToSummary() {
            // Toggle filter cards
            document.getElementById('summaryFilterCard').style.display = 'block';
            document.getElementById('detailFilterCard').style.display = 'none';
            
            // Toggle view sections
            document.getElementById('detailViewSection').style.display = 'none';
            document.getElementById('dailySummaryCard').style.display = 'block';
            selectedDate = null;
            currentView = 'summary';
        }
    </script>
    @endpush
@endsection
