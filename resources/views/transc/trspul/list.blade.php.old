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
                        <p class="text-sm mb-0 text-secondary">Tarik Data Absensi dari Fingerprint Device (FTM)</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- ALERT INFO --}}
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-info-circle fa-lg me-3"></i>
                <div>
                    <strong>Informasi:</strong> Data yang ditampilkan adalah hasil pull terbaru dari mesin fingerprint. 
                    Pilih data yang ingin dikonfirmasi untuk diproses ke sistem absensi.
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        {{-- FILTER SECTION --}}
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h6 class="text-dark font-weight-bold mb-3">
                    <i class="fas fa-filter me-2"></i>Report Absensi Fingerprint
                </h6>
                <form id="filterForm" method="GET">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="bulan" class="form-label text-sm font-weight-bold">Bulan</label>
                            <select class="form-select" id="bulan" name="bulan">
                                <option value="">-- Semua Bulan --</option>
                                <option value="2026-01">Januari 2026</option>
                                <option value="2026-02">Februari 2026</option>
                                <option value="2026-03">Maret 2026</option>
                                <option value="2026-04">April 2026</option>
                                <option value="2026-05">Mei 2026</option>
                                <option value="2026-06">Juni 2026</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="departemen" class="form-label text-sm font-weight-bold">Departemen</label>
                            <select class="form-select" id="departemen" name="departemen">
                                <option value="">-- Semua Departemen --</option>
                                <option value="produksi">Produksi</option>
                                <option value="warehouse">Warehouse</option>
                                <option value="qc">Quality Control</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="col-md-3 position-relative">
                            <label for="karyawan" class="form-label text-sm font-weight-bold">Karyawan</label>
                            <input type="text" class="form-control" id="karyawan" name="karyawan" 
                                   placeholder="Cari NIK atau Nama..." autocomplete="off">
                            <div id="karyawanDropdown" class="autocomplete-dropdown"></div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label text-sm font-weight-bold">&nbsp;</label>
                            <button type="button" class="btn btn-primary w-100 d-block" onclick="pullFingerData()">
                                <i class="fas fa-search me-2"></i>Tampilkan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- DATA TABLE --}}
        <div class="card shadow-sm" id="dataTableCard" style="display: none;">
            <div class="card-header pb-0">
                <h6 class="text-dark font-weight-bold">
                    <i class="fas fa-fingerprint me-2"></i>Data Pull Finger - <span id="displayMonth">Semua Bulan</span>
                </h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Shift</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NIK</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" colspan="2">Masuk</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" colspan="2">Keluar</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" colspan="2">Istirahat 1</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" colspan="2">Istirahat 2</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Durasi</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Scan</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Scan</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Masuk</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Keluar</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Masuk</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Keluar</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kerja</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            {{-- Data will be loaded via AJAX --}}
                        </tbody>
                    </table>
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
    </style>
    <script>
        // Global Variables
        let selectedKaryawan = null;

        // Dummy data karyawan untuk autocomplete (nanti akan dari AJAX)
        const karyawanData = [
            { nik: '001', nama: 'Ahmad Budiman' },
            { nik: '002', nama: 'Siti Nurhaliza' },
            { nik: '003', nama: 'Budi Santoso' },
            { nik: '004', nama: 'Dewi Kusuma' },
            { nik: '005', nama: 'Eko Prasetyo' },
            { nik: '006', nama: 'Fitri Handayani' },
            { nik: '007', nama: 'Gunawan Wibowo' },
            { nik: '008', nama: 'Hani Rahmawati' }
        ];

        // Initialize on page load
        $(document).ready(function() {
            setupKaryawanAutocomplete();
        });

        // Setup Karyawan Autocomplete
        function setupKaryawanAutocomplete() {
            const input = document.getElementById('karyawan');
            const dropdown = document.getElementById('karyawanDropdown');

            input.addEventListener('input', function() {
                const query = this.value.toLowerCase().trim();
                
                if (query.length === 0) {
                    dropdown.style.display = 'none';
                    selectedKaryawan = null;
                    return;
                }

                // Filter karyawan by NIK or Nama
                const filtered = karyawanData.filter(k => 
                    k.nik.includes(query) || 
                    k.nama.toLowerCase().includes(query)
                );

                if (filtered.length > 0) {
                    let html = '';
                    filtered.forEach(k => {
                        html += `<div class="autocomplete-item" onclick="selectKaryawan('${k.nik}', '${k.nama}')">
                            <strong>${k.nik}</strong> - ${k.nama}
                        </div>`;
                    });
                    dropdown.innerHTML = html;
                    dropdown.style.display = 'block';
                } else {
                    dropdown.innerHTML = '<div class="autocomplete-item">Tidak ada hasil</div>';
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

        // Select Karyawan from Autocomplete
        function selectKaryawan(nik, nama) {
            document.getElementById('karyawan').value = `${nik} - ${nama}`;
            document.getElementById('karyawanDropdown').style.display = 'none';
            selectedKaryawan = nik;
        }

        // Pull Finger Data (Filter & Display)
        function pullFingerData() {
            const bulan = document.getElementById('bulan').value;
            const departemen = document.getElementById('departemen').value;
            const karyawan = selectedKaryawan;

            // Show loading
            document.getElementById('dataTableCard').style.display = 'block';
            document.getElementById('tableBody').innerHTML = `
                <tr>
                    <td colspan="14" class="text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="text-sm text-secondary mt-3">Memuat data fingerprint...</p>
                    </td>
                </tr>
            `;

            // AJAX Request to get filtered data
            $.ajax({
                url: '{{ url("/trspul/ajax") }}',
                method: 'GET',
                data: {
                    bulan: bulan,
                    departemen: departemen,
                    karyawan: karyawan
                },
                success: function(response) {
                    console.log('Response:', response);
                    if (response.success && response.data.length > 0) {
                        renderTable(response.data);
                        
                        // Update display month
                        const bulanNames = {
                            '': 'Semua Bulan',
                            '2026-01': 'Januari 2026',
                            '2026-02': 'Februari 2026',
                            '2026-03': 'Maret 2026',
                            '2026-04': 'April 2026',
                            '2026-05': 'Mei 2026',
                            '2026-06': 'Juni 2026'
                        };
                        document.getElementById('displayMonth').textContent = bulanNames[bulan] || 'Semua Bulan';
                    } else {
                        document.getElementById('tableBody').innerHTML = `
                            <tr>
                                <td colspan="14" class="text-center py-5">
                                    <i class="fas fa-inbox fa-3x text-secondary mb-3 d-block"></i>
                                    <p class="text-sm text-secondary">Tidak ada data untuk filter yang dipilih</p>
                                </td>
                            </tr>
                        `;
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', xhr, status, error);
                    document.getElementById('tableBody').innerHTML = `
                        <tr>
                            <td colspan="14" class="text-center py-5 text-danger">
                                <i class="fas fa-exclamation-triangle fa-2x mb-3 d-block"></i>
                                <p>Error: ${error}</p>
                            </td>
                        </tr>
                    `;
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal memuat data. Silakan coba lagi.',
                        confirmButtonColor: '#028284'
                    });
                }
            });
        }

        // Render Table
        function renderTable(data) {
            let html = '';
            data.forEach((row, index) => {
                html += `
                    <tr>
                        <td class="text-center text-xs">${index + 1}</td>
                        <td class="text-center text-xs">${row.tanggal_pull || '-'}</td>
                        <td class="text-center text-xs">${row.shift_code || 'S1c'}<br><small class="text-secondary">${row.shift_name || 'Shift 1c'}</small></td>
                        <td class="text-center text-xs font-weight-bold">${row.nik || '-'}</td>
                        <td class="text-xs ps-2">${row.nama || '-'}</td>
                        <td class="text-center text-xs">${row.jam_masuk || '-'}</td>
                        <td class="text-center text-xs">${row.scan_masuk || '-'}</td>
                        <td class="text-center text-xs">${row.jam_keluar || '-'}</td>
                        <td class="text-center text-xs">${row.scan_keluar || '-'}</td>
                        <td class="text-center text-xs">${row.istirahat1_masuk || '-'}</td>
                        <td class="text-center text-xs">${row.istirahat1_keluar || '-'}</td>
                        <td class="text-center text-xs">${row.istirahat2_masuk || '-'}</td>
                        <td class="text-center text-xs">${row.istirahat2_keluar || '-'}</td>
                        <td class="text-center text-xs">${row.durasi || '-'}</td>
                    </tr>
                `;
            });
            document.getElementById('tableBody').innerHTML = html;
        }
    </script>
    @endpush
@endsection
