@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => $title ?? ''])
    <div class="container-fluid py-3">

        {{-- FILTER SECTION --}}
        <div class="card shadow-sm mb-3">
            <div class="card-body p-3">
                <div class="mb-2">
                    <h6 class="mb-0 text-dark font-weight-bold">Kirim Surat Peringatan</h6>
                </div>
                <div class="row g-3 align-items-end">
                    <div class="col-md-3 position-relative">
                        <label for="karyawan_filter" class="form-label text-sm font-weight-bold">Karyawan</label>
                        <input type="text" class="form-control" id="karyawan_filter" placeholder="Cari karyawan..." autocomplete="off">
                        <input type="hidden" id="nik_filter">
                        <div id="karyawanDropdown" class="autocomplete-dropdown"></div>
                    </div>
                    <div class="col-md-2">
                        <label for="tanggal_mulai" class="form-label text-sm font-weight-bold">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="tanggal_mulai">
                    </div>
                    <div class="col-md-2">
                        <label for="tanggal_akhir" class="form-label text-sm font-weight-bold">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="tanggal_akhir">
                    </div>
                    <div class="col-md-5 d-flex align-items-end">
                        <div class="d-flex gap-2 flex-wrap ms-auto">
                            <button class="btn btn-primary" type="button" onclick="applyFilter()">
                                <i class="fas fa-search me-1"></i>Terapkan
                            </button>
                            <button class="btn btn-secondary" type="button" onclick="resetFilter()">
                                <i class="fas fa-sync me-1"></i>Reset
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- TABLE SECTION --}}
        <div class="card shadow-sm">
            <div class="card-body pt-2 pb-0">
                <div id="spExportButtons" class="d-flex gap-2 flex-wrap"></div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-items-center mb-0" id="spTable">
                        <thead style="background-color: #00b7bd4f;">
                            <tr>
                                <th class="text-secondary text-sm font-weight-bold opacity-7 text-start" style="width: 40px;">No</th>
                                <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">NIK</th>
                                <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">Nama Karyawan</th>
                                <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">Mangkir</th>
                                <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">Izin</th>
                                <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">Cuti</th>
                                <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">Telat</th>
                                <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">Istirahat</th>
                                <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">Overtime</th>
                                <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">Pulang Cepat</th>
                                <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">Tugas</th>
                                <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">Surat Peringatan</th>
                                <th class="text-secondary text-sm font-weight-bold opacity-7 text-start" style="width: 360px;">Action</th>
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

    {{-- MODAL - Pilih Metode Hubungi --}}
    <div class="modal fade" id="hubungiModal" tabindex="-1" aria-labelledby="hubungiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-gradient-primary">
                    <h5 class="modal-title text-white" id="hubungiModalLabel">
                        <i class="fas fa-paper-plane me-2"></i>Pilih Metode Pengiriman
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="hubungi_sp_id">
                    <input type="hidden" id="hubungi_nik">
                    <input type="hidden" id="hubungi_nama">
                    
                    <div class="text-center mb-4">
                        <p class="text-sm mb-1">Kirim Surat Peringatan kepada:</p>
                        <h6 class="mb-0" id="hubungi_display_name"></h6>
                    </div>

                    <div class="row g-3">
                        <div class="col-6">
                            <button class="btn btn-success w-100 py-3" onclick="sendViaWhatsApp()">
                                <i class="fab fa-whatsapp fa-2x mb-2"></i>
                                <br>WhatsApp
                            </button>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-danger w-100 py-3" onclick="sendViaEmail()">
                                <i class="fas fa-envelope fa-2x mb-2"></i>
                                <br>Email
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .autocomplete-dropdown {
            position: absolute;
            z-index: 1000;
            display: none;
            max-height: 250px;
            overflow-y: auto;
            background: white;
            border: 1px solid #d2d6da;
            border-radius: 0.5rem;
            box-shadow: 0 0.125rem 0.5rem rgba(0, 0, 0, 0.1);
            width: 100%;
            margin-top: 2px;
        }
        .autocomplete-item {
            padding: 10px 15px;
            cursor: pointer;
            border-bottom: 1px solid #f0f0f0;
        }
        .autocomplete-item:last-child {
            border-bottom: none;
        }
        .autocomplete-item:hover {
            background-color: #f8f9fa;
        }
        .autocomplete-item strong {
            color: #344767;
        }
        .autocomplete-item small {
            color: #67748e;
        }
        .btn-action {
            padding: 4px 8px;
            font-size: 11px;
            margin: 0;
            width: auto;
            min-width: 86px;
            text-align: center;
            white-space: nowrap;
        }
        .sp-action-group {
            display: flex;
            gap: 6px;
            justify-content: center;
            flex-wrap: nowrap;
        }
    </style>

    <script>
        let spTable = null;
        let karyawanList = [];
        let currentFilters = {
            nik: '',
            tanggal_mulai: '',
            tanggal_akhir: ''
        };

        $(document).ready(function() {
            loadData();
            loadKaryawanList();
            setupAutocomplete();
        });

        function styleMsjButtons() {
            $('#spExportButtons .dt-button').addClass('btn btn-secondary');
            $('#spExportButtons .dt-button').removeClass('dt-button');
        }

        function loadKaryawanList() {
            $.ajax({
                url: '{{ url("/trssp/getkaryawan") }}',
                method: 'GET',
                data: { query: '' },
                success: function(response) {
                    if (response.success) {
                        karyawanList = response.data;
                    }
                }
            });
        }

        function setupAutocomplete() {
            const input = document.getElementById('karyawan_filter');
            const dropdown = document.getElementById('karyawanDropdown');

            input.addEventListener('input', function() {
                const query = this.value.toLowerCase().trim();

                if (query.length === 0) {
                    dropdown.style.display = 'none';
                    document.getElementById('nik_filter').value = '';
                    currentFilters.nik = '';
                    return;
                }

                const filtered = karyawanList.filter(k =>
                    k.nik.includes(query) ||
                    k.nama.toLowerCase().includes(query)
                );

                if (filtered.length > 0) {
                    dropdown.innerHTML = '';
                    filtered.forEach(k => {
                        const item = document.createElement('div');
                        item.className = 'autocomplete-item';
                        item.innerHTML = `
                            <strong>${k.nik}</strong> - ${k.nama}
                            <br><small>${k.departemen}</small>
                        `;
                        item.addEventListener('click', function() {
                            document.getElementById('nik_filter').value = k.nik;
                            document.getElementById('karyawan_filter').value = `${k.nik} - ${k.nama}`;
                            currentFilters.nik = k.nik;
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

        function applyFilter() {
            currentFilters = {
                nik: document.getElementById('nik_filter').value,
                tanggal_mulai: document.getElementById('tanggal_mulai').value,
                tanggal_akhir: document.getElementById('tanggal_akhir').value
            };
            loadData();
        }

        function resetFilter() {
            document.getElementById('karyawan_filter').value = '';
            document.getElementById('nik_filter').value = '';
            document.getElementById('tanggal_mulai').value = '';
            document.getElementById('tanggal_akhir').value = '';
            currentFilters = { nik: '', tanggal_mulai: '', tanggal_akhir: '' };
            loadData();
        }

        function loadData() {
            if (spTable) {
                spTable.destroy();
                spTable = null;
            }

            $('#spExportButtons').html('');
            $('#tableBody').html(`
                <tr>
                    <td colspan="13" class="text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="text-sm text-secondary mt-3">Memuat data SP...</p>
                    </td>
                </tr>
            `);

            $.ajax({
                url: '{{ url("/trssp/ajax") }}',
                method: 'GET',
                data: {
                    all: 1,
                    nik: currentFilters.nik,
                    tanggal_mulai: currentFilters.tanggal_mulai,
                    tanggal_akhir: currentFilters.tanggal_akhir
                },
                success: function(response) {
                    if (response.success) {
                        renderTable(response.data);
                    }
                },
                error: function() {
                    $('#tableBody').html(`
                        <tr>
                            <td colspan="13" class="text-center py-5 text-danger">
                                <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                                <p>Gagal memuat data. Silakan coba lagi.</p>
                            </td>
                        </tr>
                    `);
                }
            });
        }

        function renderTable(data) {
            let html = '';

            if (data.length === 0) {
                html = `
                    <tr>
                        <td colspan="13" class="text-center py-5">
                            <i class="fas fa-inbox fa-3x mb-3 text-secondary opacity-5"></i>
                            <p class="text-secondary mb-0">Tidak ada data</p>
                        </td>
                    </tr>
                `;
                $('#tableBody').html(html);
                return;
            }

            data.forEach((item, index) => {
                const safeNama = String(item.nama).replace(/'/g, "\\'");
                html += `
                    <tr>
                        <td>${index + 1}</td>
                        <td><strong>${item.nik}</strong></td>
                        <td>
                            <div>${item.nama}</div>
                            <small class="text-secondary">${item.departemen}</small>
                        </td>
                        <td><span class="badge badge-sm bg-danger">${item.mangkir}</span></td>
                        <td>${item.izin}</td>
                        <td>${item.cuti}</td>
                        <td>${item.telat}</td>
                        <td>${item.istirahat}</td>
                        <td>${item.overtime}</td>
                        <td>${item.pulang_cepat}</td>
                        <td>${item.tugas}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <select class="form-select form-select-sm" onchange="updateSP(${item.id}, this.value)" style="width: 100px;">
                                    <option value="SP 1" ${item.sp_level === 'SP 1' ? 'selected' : ''}>SP 1</option>
                                    <option value="SP 2" ${item.sp_level === 'SP 2' ? 'selected' : ''}>SP 2</option>
                                    <option value="SP 3" ${item.sp_level === 'SP 3' ? 'selected' : ''}>SP 3</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="sp-action-group">
                                <button class="btn btn-sm btn-info btn-action" onclick="cetakSP(${item.id})" title="Cetak SP">
                                    <i class="fas fa-print"></i> Cetak SP
                                </button>
                                <button class="btn btn-sm btn-success btn-action" onclick="openHubungiModal(${item.id}, '${item.nik}', '${safeNama}')" title="Hubungi">
                                    <i class="fas fa-paper-plane"></i> Hubungi
                                </button>
                                <button class="btn btn-sm btn-warning btn-action" onclick="markSelesai(${item.id})" title="Selesai">
                                    <i class="fas fa-check"></i> Selesai
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
            });

            $('#tableBody').html(html);

            spTable = $('#spTable').DataTable({
                language: {
                    lengthMenu: 'Tampilkan _MENU_ baris',
                    zeroRecords: 'Maaf - Data tidak ada',
                    info: 'Data _START_ - _END_ dari _TOTAL_',
                    infoEmpty: 'Tidak ada data',
                    infoFiltered: '(pencarian dari _MAX_ data)'
                },
                searching: false,
                responsive: true,
                order: [[1, 'asc']],
                dom: 'Brtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel me-1 text-lg text-success"></i><span class="font-weight-bold"> Excel',
                        autoFilter: true,
                        sheetName: 'Kirim SP',
                        exportOptions: { columns: ':visible:not(:last-child)' }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf me-1 text-lg text-danger"></i><span class="font-weight-bold"> PDF',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        exportOptions: { columns: ':visible:not(:last-child)' }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print me-1 text-lg text-info"></i><span class="font-weight-bold"> Print',
                        exportOptions: { columns: ':visible:not(:last-child)' }
                    }
                ]
            });

            spTable.buttons().container().appendTo('#spExportButtons');
            styleMsjButtons();
        }

        function cetakSP(id) {
            $.ajax({
                url: '{{ url("/trssp/cetaksp") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                            confirmButtonColor: '#028284'
                        }).then(() => {
                            loadData();
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal mencetak SP. Silakan coba lagi.',
                        confirmButtonColor: '#028284'
                    });
                }
            });
        }

        function openHubungiModal(id, nik, nama) {
            document.getElementById('hubungi_sp_id').value = id;
            document.getElementById('hubungi_nik').value = nik;
            document.getElementById('hubungi_nama').value = nama;
            document.getElementById('hubungi_display_name').textContent = `${nik} - ${nama}`;

            const modal = new bootstrap.Modal(document.getElementById('hubungiModal'));
            modal.show();
        }

        function sendViaWhatsApp() {
            const id = document.getElementById('hubungi_sp_id').value;

            $.ajax({
                url: '{{ url("/trssp/hubungi") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    method: 'whatsapp'
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                            confirmButtonColor: '#028284'
                        }).then(() => {
                            bootstrap.Modal.getInstance(document.getElementById('hubungiModal')).hide();
                            loadData();
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal mengirim via WhatsApp. Silakan coba lagi.',
                        confirmButtonColor: '#028284'
                    });
                }
            });
        }

        function sendViaEmail() {
            const id = document.getElementById('hubungi_sp_id').value;

            $.ajax({
                url: '{{ url("/trssp/hubungi") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    method: 'email'
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                            confirmButtonColor: '#028284'
                        }).then(() => {
                            bootstrap.Modal.getInstance(document.getElementById('hubungiModal')).hide();
                            loadData();
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal mengirim via Email. Silakan coba lagi.',
                        confirmButtonColor: '#028284'
                    });
                }
            });
        }

        function updateSP(id, spLevel) {
            $.ajax({
                url: '{{ url("/trssp/updatesp") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    sp_level: spLevel
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'SP Level berhasil diupdate',
                            timer: 1200,
                            showConfirmButton: false
                        });
                        loadData();
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal mengupdate SP Level. Silakan coba lagi.',
                        confirmButtonColor: '#028284'
                    });
                    loadData();
                }
            });
        }

        function markSelesai(id) {
            Swal.fire({
                title: 'Tandai selesai?',
                text: 'Data akan dipindahkan ke laporan.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#028284',
                cancelButtonColor: '#8392ab',
                confirmButtonText: 'Ya, selesaikan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (!result.isConfirmed) {
                    return;
                }

                $.ajax({
                    url: '{{ url("/trssp/selesai") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message,
                                confirmButtonColor: '#028284'
                            }).then(() => {
                                loadData();
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Gagal menandai sebagai selesai. Silakan coba lagi.',
                            confirmButtonColor: '#028284'
                        });
                    }
                });
            });
        }
    </script>
@endsection
