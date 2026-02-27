@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav')
    
    <div class="container-fluid py-4">
        {{-- PAGE HEADER --}}
        <div class="card shadow-sm mb-4">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="mb-0 text-dark font-weight-bold">Data Missing</h6>
                    </div>
                </div>
            </div>
        </div>

        {{-- FILTER SECTION --}}
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form id="filterForm" method="GET">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="tanggal_mulai" class="form-label text-sm font-weight-bold">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="2026-02-01">
                        </div>
                        <div class="col-md-3">
                            <label for="tanggal_akhir" class="form-label text-sm font-weight-bold">Tanggal Akhir</label>
                            <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" value="2026-02-12">
                        </div>
                        <div class="col-md-3 position-relative">
                            <label for="karyawan" class="form-label text-sm font-weight-bold">Karyawan</label>
                            <input type="text" class="form-control" id="karyawan" name="karyawan" 
                                   placeholder="Cari NIK atau Nama..." autocomplete="off">
                            <div id="karyawanDropdown" class="autocomplete-dropdown"></div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label text-sm font-weight-bold">&nbsp;</label>
                            <button type="button" class="btn btn-primary w-100 d-block" onclick="getDataMissing()">
                                <i class="fas fa-search me-2"></i>Tampilkan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- ACTION BAR --}}
        <div class="card shadow-sm mb-3" id="actionBar" style="display: none;">
            <div class="card-body p-3">
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <span class="text-sm me-2">
                        <strong class="text-primary" id="selectedCount">0</strong> data terpilih
                    </span>
                    <button class="btn btn-sm btn-primary" onclick="toggleSelectAll()">
                        <i class="fas fa-check-square me-1"></i>Pilih Semua
                    </button>
                    <button class="btn btn-sm btn-success" onclick="konfirmasiSelected()">
                        <i class="fas fa-check-circle me-1"></i>Konfirmasi Data Terpilih
                    </button>
                    <button class="btn btn-sm btn-secondary" onclick="getDataMissing()">
                        <i class="fas fa-sync me-1"></i>Refresh
                    </button>
                </div>
            </div>
        </div>

        {{-- DATA TABLE --}}
        <div class="card shadow-sm" id="dataTableCard" style="display: none;">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 40px;">
                                    <input type="checkbox" id="selectAll" onchange="toggleSelectAll()">
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NO</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TANGGAL</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NIK</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NAMA KARYAWAN</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">SHIFT</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">JAM MASUK</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TERLAMBAT</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">JAM KELUAR</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">PULANG CEPAT</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">STATUS</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">KETERANGAN</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ACTION</th>
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

    {{-- MODAL EDIT KETERANGAN --}}
    <div class="modal fade" id="editKeteranganModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Keterangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit_id">
                    <div class="mb-3">
                        <label class="form-label">NIK</label>
                        <input type="text" class="form-control" id="edit_nik" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" id="edit_nama" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="text" class="form-control" id="edit_tanggal" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <select class="form-select" id="edit_keterangan" onchange="toggleCustomKeterangan()">
                            <option value="">Pilih Keterangan</option>
                            <option value="Izin Pulang Cepat">Izin Pulang Cepat</option>
                            <option value="Mangkir/Tanpa Keterangan">Mangkir/Tanpa Keterangan</option>
                            <option value="Cuti Tahunan">Cuti Tahunan</option>
                            <option value="Sakit">Sakit</option>
                            <option value="Izin">Izin</option>
                            <option value="Dinas Luar">Dinas Luar</option>
                            <option value="custom">Lainnya (Isi Manual)</option>
                        </select>
                    </div>
                    <div class="mb-3" id="customKeteranganDiv" style="display: none;">
                        <label class="form-label">Keterangan Manual</label>
                        <textarea class="form-control" id="edit_keterangan_custom" rows="3" placeholder="Masukkan keterangan..." maxlength="255"></textarea>
                        <small class="text-muted">Maksimal 255 karakter</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="saveKeterangan()">Simpan</button>
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
            { nik: '169987', nama: 'Ahmad Fauzi' },
            { nik: '235578', nama: 'Citra Dewi' },
            { nik: '007122', nama: 'Gita Maharani' },
            { nik: '090744', nama: 'Hani Purnomo' },
            { nik: '099744', nama: 'Hari Purnomo' },
            { nik: '123456', nama: 'Budi Santoso' },
            { nik: '234567', nama: 'Dewi Kusuma' },
            { nik: '345678', nama: 'Eko Prasetyo' }
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

        // Get Data Missing (Filter & Display)
        function getDataMissing() {
            const tanggalMulai = document.getElementById('tanggal_mulai').value;
            const tanggalAkhir = document.getElementById('tanggal_akhir').value;
            const karyawan = selectedKaryawan;

            // Show loading
            document.getElementById('dataTableCard').style.display = 'block';
            document.getElementById('actionBar').style.display = 'none';
            document.getElementById('tableBody').innerHTML = `
                <tr>
                    <td colspan="13" class="text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="text-sm text-secondary mt-3">Memuat data missing...</p>
                    </td>
                </tr>
            `;

            // AJAX Request to get filtered data
            $.ajax({
                url: '{{ url("/trsmis/ajax") }}',
                method: 'GET',
                data: {
                    tanggal_mulai: tanggalMulai,
                    tanggal_akhir: tanggalAkhir,
                    karyawan: karyawan
                },
                success: function(response) {
                    console.log('Response:', response);
                    if (response.success && response.data.length > 0) {
                        renderTable(response.data);
                        document.getElementById('actionBar').style.display = 'block';
                    } else {
                        document.getElementById('tableBody').innerHTML = `
                            <tr>
                                <td colspan="13" class="text-center py-5">
                                    <i class="fas fa-inbox fa-3x text-secondary mb-3 d-block"></i>
                                    <p class="text-sm text-secondary">Tidak ada data missing untuk periode yang dipilih</p>
                                </td>
                            </tr>
                        `;
                        document.getElementById('actionBar').style.display = 'none';
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', xhr, status, error);
                    document.getElementById('tableBody').innerHTML = `
                        <tr>
                            <td colspan="13" class="text-center py-5 text-danger">
                                <i class="fas fa-exclamation-triangle fa-2x mb-3 d-block"></i>
                                <p>Error: ${error}</p>
                            </td>
                        </tr>
                    `;
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal memuat data. Silakan coba lagi.',
                        confirmButtonColor: '#5e72e4'
                    });
                }
            });
        }

        // Render Table
        function renderTable(data) {
            let html = '';
            data.forEach((row, index) => {
                // Status badge colors
                const statusColors = {
                    'danger': 'bg-gradient-danger',
                    'warning': 'bg-gradient-warning',
                    'secondary': 'bg-gradient-secondary',
                    'success': 'bg-gradient-success',
                    'info': 'bg-gradient-info'
                };
                
                const statusBadge = statusColors[row.status_badge] || 'bg-gradient-secondary';
                const keteranganBadge = statusColors[row.keterangan_badge] || 'bg-gradient-secondary';
                
                html += `
                    <tr>
                        <td class="text-center">
                            <input type="checkbox" class="row-checkbox" value="${row.id}" onchange="updateSelectedCount()">
                        </td>
                        <td class="text-center text-xs">${index + 1}</td>
                        <td class="text-center text-xs">${formatDate(row.tanggal)}</td>
                        <td class="text-center text-xs font-weight-bold">${row.nik}</td>
                        <td class="text-xs ps-2">${row.nama}</td>
                        <td class="text-center text-xs">${row.shift}</td>
                        <td class="text-center text-xs">
                            ${row.jam_masuk ? row.jam_masuk : '<span class="badge badge-sm bg-gradient-danger">Missing</span>'}
                        </td>
                        <td class="text-center text-xs">
                            ${row.terlambat ? row.terlambat : '-'}
                        </td>
                        <td class="text-center text-xs">
                            ${row.jam_keluar ? row.jam_keluar : '<span class="badge badge-sm bg-gradient-danger">Missing</span>'}
                        </td>
                        <td class="text-center text-xs">
                            ${row.pulang_cepat ? row.pulang_cepat : '-'}
                        </td>
                        <td class="text-center">
                            <span class="badge badge-sm ${statusBadge}">${row.status}</span>
                        </td>
                        <td class="text-center text-xs">${row.keterangan}</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-warning" onclick="editKeterangan(${row.id}, '${row.nik}', '${row.nama}', '${row.tanggal}', '${row.keterangan}')">
                                <i class="fas fa-edit"></i> Edit Keterangan
                            </button>
                        </td>
                    </tr>
                `;
            });
            document.getElementById('tableBody').innerHTML = html;
            updateSelectedCount();
        }

        // Format date to DD/MM/YYYY
        function formatDate(dateStr) {
            if (!dateStr) return '-';
            const date = new Date(dateStr);
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();
            return `${year}-${month}-${day}`;
        }

        // Toggle Select All Checkboxes
        function toggleSelectAll() {
            const selectAll = document.getElementById('selectAll');
            const checkboxes = document.querySelectorAll('.row-checkbox');
            checkboxes.forEach(cb => cb.checked = !selectAll.checked);
            selectAll.checked = !selectAll.checked;
            updateSelectedCount();
        }

        // Update Selected Count
        function updateSelectedCount() {
            const checkboxes = document.querySelectorAll('.row-checkbox:checked');
            document.getElementById('selectedCount').textContent = checkboxes.length;
        }

        // Edit Keterangan
        function editKeterangan(id, nik, nama, tanggal, keterangan) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_nik').value = nik;
            document.getElementById('edit_nama').value = nama;
            document.getElementById('edit_tanggal').value = formatDate(tanggal);
            
            // Check if keterangan is custom (not in predefined options)
            const predefinedOptions = [
                'Izin Pulang Cepat', 'Mangkir/Tanpa Keterangan', 
                'Cuti Tahunan', 'Sakit', 'Izin', 'Dinas Luar'
            ];
            
            if (predefinedOptions.includes(keterangan)) {
                document.getElementById('edit_keterangan').value = keterangan;
                document.getElementById('customKeteranganDiv').style.display = 'none';
            } else {
                document.getElementById('edit_keterangan').value = 'custom';
                document.getElementById('edit_keterangan_custom').value = keterangan;
                document.getElementById('customKeteranganDiv').style.display = 'block';
            }
            
            const modal = new bootstrap.Modal(document.getElementById('editKeteranganModal'));
            modal.show();
        }

        // Toggle Custom Keterangan Input
        function toggleCustomKeterangan() {
            const select = document.getElementById('edit_keterangan');
            const customDiv = document.getElementById('customKeteranganDiv');
            
            if (select.value === 'custom') {
                customDiv.style.display = 'block';
                document.getElementById('edit_keterangan_custom').focus();
            } else {
                customDiv.style.display = 'none';
                document.getElementById('edit_keterangan_custom').value = '';
            }
        }

        // Save Keterangan
        function saveKeterangan() {
            const id = document.getElementById('edit_id').value;
            let keterangan = document.getElementById('edit_keterangan').value;

            // If custom, get the custom input value
            if (keterangan === 'custom') {
                keterangan = document.getElementById('edit_keterangan_custom').value.trim();
                if (!keterangan) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: 'Silakan isi keterangan manual',
                        confirmButtonColor: '#5e72e4'
                    });
                    return;
                }
            }

            if (!keterangan) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Silakan pilih keterangan',
                    confirmButtonColor: '#5e72e4'
                });
                return;
            }

            $.ajax({
                url: '{{ url("/trsmis/updateketerangan") }}',
                method: 'POST',
                data: {
                    id: id,
                    keterangan: keterangan,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                            confirmButtonColor: '#5e72e4'
                        }).then(() => {
                            bootstrap.Modal.getInstance(document.getElementById('editKeteranganModal')).hide();
                            getDataMissing();
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal menyimpan keterangan',
                        confirmButtonColor: '#5e72e4'
                    });
                }
            });
        }

        // Konfirmasi Selected Data
        function konfirmasiSelected() {
            const checkboxes = document.querySelectorAll('.row-checkbox:checked');
            
            if (checkboxes.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Pilih minimal satu data untuk dikonfirmasi',
                    confirmButtonColor: '#5e72e4'
                });
                return;
            }

            const selectedIds = Array.from(checkboxes).map(cb => cb.value);

            Swal.fire({
                title: 'Konfirmasi Data Terpilih?',
                html: `Anda akan mengkonfirmasi <strong>${selectedIds.length}</strong> data missing.<br>
                       Data yang dikonfirmasi akan diproses ke sistem.`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: '<i class="fas fa-check me-1"></i> Ya, Konfirmasi',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#5e72e4',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return $.ajax({
                        url: '{{ url("/trsmis/konfirmasi") }}',
                        method: 'POST',
                        data: {
                            ids: selectedIds,
                            _token: '{{ csrf_token() }}'
                        }
                    });
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        html: `<strong>${result.value.confirmed}</strong> data berhasil dikonfirmasi`,
                        confirmButtonColor: '#5e72e4'
                    }).then(() => {
                        getDataMissing();
                    });
                }
            });
        }
    </script>
    @endpush
@endsection
