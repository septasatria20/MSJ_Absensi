@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav')
    
    <div class="container-fluid py-3">
        {{-- FILTER + DATA SECTION --}}
        <div class="card shadow-sm mb-4" id="dataMissingContainer">
            <div class="card-body pb-2">
                <div class="mb-2">
                    <h6 class="mb-0 text-dark font-weight-bold">Data Missing</h6>
                </div>
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
                        <div class="col-md-3">
                            <label for="karyawan" class="form-label text-sm font-weight-bold">Karyawan</label>
                            <input type="text" class="form-control" id="karyawan" name="karyawan" 
                                   placeholder="Masukkan NIK/Nama Karyawan">
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

            {{-- ACTION BAR --}}
            <div class="px-3 pb-2 d-flex flex-column align-items-start gap-2" id="actionBar">
                <div class="d-flex justify-content-between align-items-center w-100 flex-wrap gap-2">
                    <div id="dataMissingExportButtons" class="d-flex gap-2 flex-wrap justify-content-start"></div>
                    <div id="lastKonfirmasiInfoWrap" class="d-flex justify-content-end">
                        <div class="badge bg-gradient-info text-white px-3 py-2 shadow-sm border border-info-subtle" style="font-size: 0.8rem; font-weight: 600; white-space: nowrap;">
                            <i class="fas fa-clock me-1"></i>
                            <span id="lastKonfirmasiInfo">Terakhir kali konfirmasi: belum ada</span>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2 flex-wrap" id="primaryActionButtons">
                    <span class="text-sm me-2">
                        <strong class="text-primary" id="selectedCount">0</strong> data terpilih
                    </span>
                    <button class="btn btn-primary action-btn-uniform" onclick="toggleSelectAll()">
                        <i class="fas fa-check-square me-1"></i>Pilih Semua
                    </button>
                    <button class="btn btn-success action-btn-uniform" onclick="konfirmasiSelected()">
                        <i class="fas fa-check-circle me-1"></i>Konfirmasi Data Terpilih
                    </button>
                    <button class="btn btn-secondary action-btn-uniform" onclick="getDataMissing()">
                        <i class="fas fa-sync me-1"></i>Refresh
                    </button>
                </div>
            </div>

            {{-- DATA TABLE --}}
            <div id="dataTableCard" class="pb-3 px-3">
                <div class="table-responsive table-wrap-centered">
                    <table class="table table-hover align-items-center mb-0" id="dataMissingTable">
                        <thead class="thead-light" style="background-color: #00b7bd4f;">
                            <tr>
                                <th class="text-secondary text-sm font-weight-bold opacity-7 text-start" style="width: 40px;">
                                    <input type="checkbox" id="selectAll" onchange="syncSelectAllRows(this.checked)">
                                </th>
                                <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">No</th>
                                <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">Tanggal</th>
                                <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">NIK</th>
                                <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">Nama Karyawan</th>
                                <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">Shift</th>
                                <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">Jam Masuk</th>
                                <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">Terlambat</th>
                                <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">Jam Keluar</th>
                                <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">Pulang Cepat</th>
                                <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">Status</th>
                                <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">Keterangan</th>
                                <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <tr>
                                <td colspan="13" class="text-center py-4 text-secondary">
                                    Klik tombol Tampilkan untuk memuat data.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="px-3 pb-3" id="outsideUnconfirmedSection" style="display: none;">
                <h6 class="mb-2 text-dark font-weight-bold">Belum Konfirmasi di Luar Filter</h6>
                <p class="text-xs text-secondary mb-2" id="outsideUnconfirmedNote"></p>
                <div class="table-responsive table-wrap-centered">
                    <table class="table table-hover align-items-center mb-0" id="outsideUnconfirmedTable">
                        <thead style="background-color: #00b7bd4f;">
                            <tr>
                                <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">No</th>
                                <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">Tanggal</th>
                                <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">NIK</th>
                                <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">Nama Karyawan</th>
                                <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">Shift</th>
                                <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">Jam Masuk</th>
                                <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">Terlambat</th>
                                <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">Jam Keluar</th>
                                <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">Pulang Cepat</th>
                                <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">Status</th>
                                <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">Keterangan</th>
                                <th class="text-secondary text-sm font-weight-bold opacity-7 text-start">Action</th>
                            </tr>
                        </thead>
                        <tbody id="outsideUnconfirmedBody"></tbody>
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
        .table-wrap-centered,
        #dataMissingTable_wrapper,
        #outsideUnconfirmedTable_wrapper {
            max-width: 100%;
            margin: 0;
        }
        #actionBar .action-btn-uniform,
        #dataMissingExportButtons .btn {
            font-size: 0.875rem;
            padding: 0.5rem 0.9rem;
            line-height: 1.2;
        }
        #dataMissingExportButtons,
        #primaryActionButtons {
            margin-left: 0;
            padding-left: 0;
        }
        #actionBar {
            gap: 0.35rem !important;
            padding-bottom: 0.4rem !important;
        }
        #actionBar #primaryActionButtons {
            margin-bottom: 0;
        }
        #lastKonfirmasiInfoWrap {
            min-height: 34px;
        }
    </style>
    <script>
        let dataMissingTable = null;
        let outsideUnconfirmedTable = null;

        $(document).ready(function() {});

        function styleMsjButtons() {
            $('#dataMissingExportButtons .dt-button').addClass('btn btn-secondary');
            $('#dataMissingExportButtons .dt-button').removeClass('dt-button');
        }

        function getDataMissing() {
            const tanggalMulai = document.getElementById('tanggal_mulai').value;
            const tanggalAkhir = document.getElementById('tanggal_akhir').value;
            const karyawan = document.getElementById('karyawan').value.trim();

            document.getElementById('selectedCount').textContent = '0';
            document.getElementById('selectAll').checked = false;
            document.getElementById('outsideUnconfirmedSection').style.display = 'none';

            if (dataMissingTable) {
                dataMissingTable.destroy();
                dataMissingTable = null;
            }

            if (outsideUnconfirmedTable) {
                outsideUnconfirmedTable.destroy();
                outsideUnconfirmedTable = null;
            }

            document.getElementById('dataMissingExportButtons').innerHTML = '';
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

            $.ajax({
                url: '{{ url("/trsmis/ajax") }}',
                method: 'GET',
                data: {
                    tanggal_mulai: tanggalMulai,
                    tanggal_akhir: tanggalAkhir,
                    karyawan: karyawan
                },
                success: function(response) {
                    renderLastKonfirmasi(response.last_confirmed_at_formatted);
                    renderOutsideUnconfirmed(response.outside_unconfirmed || [], response.outside_unconfirmed_total_rows || 0);

                    if (response.success && response.data.length > 0) {
                        renderTable(response.data);
                    } else {
                        document.getElementById('tableBody').innerHTML = `
                            <tr>
                                <td colspan="13" class="text-center py-5">
                                    <i class="fas fa-inbox fa-3x text-secondary mb-3 d-block"></i>
                                    <p class="text-sm text-secondary">Tidak ada data missing untuk periode yang dipilih</p>
                                </td>
                            </tr>
                        `;
                        document.getElementById('selectedCount').textContent = '0';
                        document.getElementById('selectAll').checked = false;
                    }
                },
                error: function(xhr, status, error) {
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

        function renderLastKonfirmasi(lastConfirmedAtFormatted) {
            const target = document.getElementById('lastKonfirmasiInfo');

            if (!target) {
                return;
            }

            if (!lastConfirmedAtFormatted) {
                target.textContent = 'Terakhir kali konfirmasi: belum ada';
            } else {
                target.textContent = `Terakhir kali konfirmasi: ${lastConfirmedAtFormatted}`;
            }
        }

        function renderOutsideUnconfirmed(data, totalRows) {
            const section = document.getElementById('outsideUnconfirmedSection');
            const body = document.getElementById('outsideUnconfirmedBody');
            const note = document.getElementById('outsideUnconfirmedNote');

            if (outsideUnconfirmedTable) {
                outsideUnconfirmedTable.destroy();
                outsideUnconfirmedTable = null;
            }

            if (!Array.isArray(data) || data.length === 0) {
                section.style.display = 'none';
                body.innerHTML = '';
                note.textContent = '';
                return;
            }

            note.textContent = `${totalRows} baris data belum dikonfirmasi di luar filter aktif.`;

            body.innerHTML = buildRowsHtml(data, false);
            section.style.display = 'block';

            outsideUnconfirmedTable = $('#outsideUnconfirmedTable').DataTable({
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
                dom: 'rtip'
            });
        }

        function escapeHtml(value) {
            return String(value)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        function escapeForJsSingleQuote(value) {
            return String(value)
                .replace(/\\/g, '\\\\')
                .replace(/'/g, "\\'")
                .replace(/\n/g, ' ')
                .replace(/\r/g, ' ');
        }

        function buildRowsHtml(data, withCheckbox = true) {
            let html = '';

            data.forEach((row, index) => {
                const statusColors = {
                    danger: 'bg-gradient-danger',
                    warning: 'bg-gradient-warning',
                    secondary: 'bg-gradient-secondary',
                    success: 'bg-gradient-success',
                    info: 'bg-gradient-info'
                };

                const statusBadge = statusColors[row.status_badge] || 'bg-gradient-secondary';
                const escapedKeterangan = escapeForJsSingleQuote(row.keterangan || '');
                const escapedNama = escapeForJsSingleQuote(row.nama || '');

                html += `
                    <tr>
                        ${withCheckbox ? `<td><input type="checkbox" class="row-checkbox" value="${row.id}" onchange="updateSelectedCount()"></td>` : ''}
                        <td>${index + 1}</td>
                        <td>${formatDate(row.tanggal)}</td>
                        <td><strong>${escapeHtml(row.nik || '-')}</strong></td>
                        <td>${escapeHtml(row.nama || '-')}</td>
                        <td>${escapeHtml(row.shift || '-')}</td>
                        <td>${row.jam_masuk ? escapeHtml(row.jam_masuk) : '<span class="badge badge-sm bg-gradient-danger">Missing</span>'}</td>
                        <td>${row.terlambat ? escapeHtml(row.terlambat) : '-'}</td>
                        <td>${row.jam_keluar ? escapeHtml(row.jam_keluar) : '<span class="badge badge-sm bg-gradient-danger">Missing</span>'}</td>
                        <td>${row.pulang_cepat ? escapeHtml(row.pulang_cepat) : '-'}</td>
                        <td><span class="badge badge-sm ${statusBadge}">${escapeHtml(row.status || '-')}</span></td>
                        <td>${escapeHtml(row.keterangan || '-')}</td>
                        <td>
                            <button class="btn btn-sm btn-warning" onclick="editKeterangan(${row.id}, '${escapeForJsSingleQuote(row.nik || '')}', '${escapedNama}', '${escapeForJsSingleQuote(row.tanggal || '')}', '${escapedKeterangan}')">
                                <i class="fas fa-edit"></i> Edit Keterangan
                            </button>
                        </td>
                    </tr>
                `;
            });

            return html;
        }

        function renderTable(data) {
            document.getElementById('tableBody').innerHTML = buildRowsHtml(data, true);

            dataMissingTable = $('#dataMissingTable').DataTable({
                language: {
                    lengthMenu: 'Tampilkan _MENU_ baris',
                    zeroRecords: 'Maaf - Data tidak ada',
                    info: 'Data _START_ - _END_ dari _TOTAL_',
                    infoEmpty: 'Tidak ada data',
                    infoFiltered: '(pencarian dari _MAX_ data)'
                },
                searching: false,
                responsive: true,
                order: [[2, 'desc']],
                dom: 'Brtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel me-1 text-lg text-success"></i><span class="font-weight-bold"> Excel',
                        autoFilter: true,
                        sheetName: 'Data Missing',
                        exportOptions: { columns: ':visible:not(:first-child):not(:last-child)' }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf me-1 text-lg text-danger"></i><span class="font-weight-bold"> PDF',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        exportOptions: { columns: ':visible:not(:first-child):not(:last-child)' }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print me-1 text-lg text-info"></i><span class="font-weight-bold"> Print',
                        exportOptions: { columns: ':visible:not(:first-child):not(:last-child)' }
                    }
                ]
            });

            dataMissingTable.buttons().container().appendTo('#dataMissingExportButtons');
            styleMsjButtons();
            document.getElementById('selectAll').checked = false;
            updateSelectedCount();
        }

        function formatDate(dateStr) {
            if (!dateStr) return '-';
            const date = new Date(dateStr);
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();
            return `${year}-${month}-${day}`;
        }

        function syncSelectAllRows(isChecked) {
            const checkboxes = document.querySelectorAll('.row-checkbox');
            checkboxes.forEach(cb => {
                cb.checked = isChecked;
            });
            updateSelectedCount();
        }

        function toggleSelectAll() {
            const selectAll = document.getElementById('selectAll');
            selectAll.checked = !selectAll.checked;
            syncSelectAllRows(selectAll.checked);
        }

        function updateSelectedCount() {
            const checkedCount = document.querySelectorAll('.row-checkbox:checked').length;
            const totalCount = document.querySelectorAll('.row-checkbox').length;
            document.getElementById('selectedCount').textContent = checkedCount;
            document.getElementById('selectAll').checked = totalCount > 0 && checkedCount === totalCount;
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
