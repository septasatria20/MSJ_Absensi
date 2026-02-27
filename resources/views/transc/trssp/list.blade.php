@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => $title ?? ''])
    <div class="container-fluid py-4">

        {{-- PAGE HEADER --}}
        <div class="card shadow-sm mb-4">
            <div class="card-body p-3">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0 text-dark font-weight-bold">Kirim Surat Peringatan</h6>
                        <p class="text-sm mb-0 text-secondary">Manajemen dan Pengiriman Surat Peringatan Karyawan</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- FILTER SECTION --}}
        <div class="card shadow-sm mb-3">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center">
                    {{-- Left: Export Buttons --}}
                    <div class="d-flex gap-2">
                        <button class="btn btn-sm btn-danger" onclick="exportPDF()">
                            <i class="fas fa-file-pdf me-1"></i>PDF
                        </button>
                        <button class="btn btn-sm btn-secondary" onclick="printTable()">
                            <i class="fas fa-print me-1"></i>Print
                        </button>
                        <button class="btn btn-sm btn-secondary" onclick="resetFilter()">
                            <i class="fas fa-sync me-1"></i>Reset
                        </button>
                    </div>

                    {{-- Right: Search Filter --}}
                    <div style="width: 350px;">
                        <div class="input-group">
                            <input type="text" class="form-control" id="karyawan_filter" 
                                   placeholder="Cari karyawan..." autocomplete="off">
                            <input type="hidden" id="nik_filter">
                            <span class="input-group-text bg-white">
                                <i class="fas fa-search text-secondary"></i>
                            </span>
                            <div id="karyawanDropdown" class="autocomplete-dropdown"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- TABLE SECTION --}}
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-items-center mb-0">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3" style="width: 40px;">NO</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NIK</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NAMA KARYAWAN</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">MANGKIR</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">IZIN</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">CUTI</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">TELAT</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">ISTIRAHAT</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">OVERTIME</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">PULANG CEPAT</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">TUGAS</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">SURAT PERINGATAN</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center" style="width: 280px;">ACTION</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            {{-- Data will be loaded via AJAX --}}
                        </tbody>
                    </table>
                </div>

                {{-- PAGINATION --}}
                <div class="card-footer pb-3">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center mb-0" id="pagination">
                            {{-- Pagination will be rendered here --}}
                        </ul>
                    </nav>
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
        .table td {
            padding: 12px 8px;
            font-size: 13px;
            vertical-align: middle;
        }
        .btn-action {
            padding: 6px 12px;
            font-size: 11px;
            margin: 0;
            width: 95px;
            text-align: center;
        }
    </style>

    <script>
        let currentPage = 1;
        let karyawanList = [];
        let currentFilters = {
            nik: ''
        };

        // Initialize
        $(document).ready(function() {
            loadData(1);
            loadKaryawanList();
            setupAutocomplete();
        });

        // Load Karyawan List for Autocomplete
        function loadKaryawanList() {
            console.log('Loading karyawan list...');
            $.ajax({
                url: '{{ url("/trssp/getkaryawan") }}',
                method: 'GET',
                data: { query: '' },
                success: function(response) {
                    console.log('Karyawan response:', response);
                    if (response.success) {
                        karyawanList = response.data;
                        console.log('✓ Loaded ' + karyawanList.length + ' karyawan');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('✗ AJAX Error loading karyawan:', error);
                }
            });
        }

        // Setup Autocomplete
        function setupAutocomplete() {
            const input = document.getElementById('karyawan_filter');
            const dropdown = document.getElementById('karyawanDropdown');

            input.addEventListener('input', function() {
                const query = this.value.toLowerCase().trim();
                
                if (query.length === 0) {
                    dropdown.style.display = 'none';
                    document.getElementById('nik_filter').value = '';
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
                            dropdown.style.display = 'none';
                            currentFilters.nik = k.nik;
                            loadData(1);
                        });
                        
                        dropdown.appendChild(item);
                    });
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

        // Reset Filter
        function resetFilter() {
            document.getElementById('karyawan_filter').value = '';
            document.getElementById('nik_filter').value = '';
            currentFilters = { nik: '' };
            loadData(1);
        }

        // Load Data
        function loadData(page = 1) {
            currentPage = page;
            
            $.ajax({
                url: '{{ url("/trssp/ajax") }}',
                method: 'GET',
                data: {
                    page: page,
                    nik: currentFilters.nik
                },
                success: function(response) {
                    if (response.success) {
                        renderTable(response.data);
                        renderPagination(response.pagination);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error loading data:', error);
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

        // Render Table
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
            } else {
                data.forEach((item, index) => {
                    const no = (currentPage - 1) * 10 + index + 1;
                    
                    // Status icons
                    const waIcon = item.wa_sent ? '<i class="fas fa-check-circle text-success"></i>' : '';
                    const emailIcon = item.email_sent ? '<i class="fas fa-check-circle text-success"></i>' : '';
                    
                    html += `
                        <tr>
                            <td class="ps-3">${no}</td>
                            <td><strong>${item.nik}</strong></td>
                            <td>
                                <div>${item.nama}</div>
                                <small class="text-secondary">${item.departemen}</small>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-sm bg-danger">${item.mangkir}</span>
                            </td>
                            <td class="text-center">${item.izin}</td>
                            <td class="text-center">${item.cuti}</td>
                            <td class="text-center">${item.telat}</td>
                            <td class="text-center">${item.istirahat}</td>
                            <td class="text-center">${item.overtime}</td>
                            <td class="text-center">${item.pulang_cepat}</td>
                            <td class="text-center">${item.tugas}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <select class="form-select form-select-sm" onchange="updateSP(${item.id}, this.value)" style="width: 100px;">
                                        <option value="SP 1" ${item.sp_level === 'SP 1' ? 'selected' : ''}>SP 1</option>
                                        <option value="SP 2" ${item.sp_level === 'SP 2' ? 'selected' : ''}>SP 2</option>
                                        <option value="SP 3" ${item.sp_level === 'SP 3' ? 'selected' : ''}>SP 3</option>
                                    </select>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="d-flex gap-2 justify-content-center">
                                    <button class="btn btn-sm btn-info btn-action" onclick="cetakSP(${item.id})" title="Cetak SP">
                                        <i class="fas fa-print"></i> Cetak SP
                                    </button>
                                    <button class="btn btn-sm btn-success btn-action" onclick="openHubungiModal(${item.id}, '${item.nik}', '${item.nama}')" title="Hubungi ${waIcon ? '✓ WhatsApp' : ''} ${emailIcon ? '✓ Email' : ''}">
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
            }
            
            $('#tableBody').html(html);
        }

        // Render Pagination
        function renderPagination(pagination) {
            let html = '';
            const current = pagination.current_page;
            const last = pagination.last_page;

            if (last <= 1) {
                $('#pagination').html('');
                return;
            }

            // Previous button
            html += `
                <li class="page-item ${current === 1 ? 'disabled' : ''}">
                    <a class="page-link" href="javascript:void(0)" onclick="${current > 1 ? 'loadData(' + (current - 1) + ')' : ''}">
                        <i class="fas fa-angle-left"></i> Previous
                    </a>
                </li>
            `;

            // Always show first page
            html += `
                <li class="page-item ${current === 1 ? 'active' : ''}">
                    <a class="page-link" href="javascript:void(0)" onclick="loadData(1)">1</a>
                </li>
            `;

            // Show ellipsis if needed
            if (current > 3) {
                html += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
            }

            // Show pages around current
            for (let i = Math.max(2, current - 1); i <= Math.min(last - 1, current + 1); i++) {
                html += `
                    <li class="page-item ${current === i ? 'active' : ''}">
                        <a class="page-link" href="javascript:void(0)" onclick="loadData(${i})">${i}</a>
                    </li>
                `;
            }

            // Show ellipsis if needed
            if (current < last - 2) {
                html += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
            }

            // Always show last page if more than 1 page
            if (last > 1) {
                html += `
                    <li class="page-item ${current === last ? 'active' : ''}">
                        <a class="page-link" href="javascript:void(0)" onclick="loadData(${last})">${last}</a>
                    </li>
                `;
            }

            // Next button
            html += `
                <li class="page-item ${current === last ? 'disabled' : ''}">
                    <a class="page-link" href="javascript:void(0)" onclick="${current < last ? 'loadData(' + (current + 1) + ')' : ''}">
                        Next <i class="fas fa-angle-right"></i>
                    </a>
                </li>
            `;

            $('#pagination').html(html);
        }

        // Cetak SP
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
                        alert(response.message);
                        // Open PDF in new tab
                        // window.open(response.pdf_url, '_blank');
                        loadData(currentPage);
                    }
                },
                error: function() {
                    alert('Gagal mencetak SP. Silakan coba lagi.');
                }
            });
        }

        // Open Hubungi Modal
        function openHubungiModal(id, nik, nama) {
            document.getElementById('hubungi_sp_id').value = id;
            document.getElementById('hubungi_nik').value = nik;
            document.getElementById('hubungi_nama').value = nama;
            document.getElementById('hubungi_display_name').textContent = `${nik} - ${nama}`;
            
            const modal = new bootstrap.Modal(document.getElementById('hubungiModal'));
            modal.show();
        }

        // Send via WhatsApp
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
                        alert(response.message);
                        bootstrap.Modal.getInstance(document.getElementById('hubungiModal')).hide();
                        loadData(currentPage);
                    }
                },
                error: function() {
                    alert('Gagal mengirim via WhatsApp. Silakan coba lagi.');
                }
            });
        }

        // Send via Email
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
                        alert(response.message);
                        bootstrap.Modal.getInstance(document.getElementById('hubungiModal')).hide();
                        loadData(currentPage);
                    }
                },
                error: function() {
                    alert('Gagal mengirim via Email. Silakan coba lagi.');
                }
            });
        }

        // Update SP Level
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
                        alert('SP Level berhasil diupdate');
                        loadData(currentPage);
                    }
                },
                error: function() {
                    alert('Gagal mengupdate SP Level. Silakan coba lagi.');
                    loadData(currentPage);
                }
            });
        }

        // Mark SP as Completed
        function markSelesai(id) {
            if (!confirm('Tandai SP ini sebagai selesai? Data akan dipindahkan ke laporan.')) {
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
                        alert(response.message);
                        loadData(currentPage);
                    }
                },
                error: function() {
                    alert('Gagal menandai sebagai selesai. Silakan coba lagi.');
                }
            });
        }

        // Export PDF
        function exportPDF() {
            alert('Export PDF akan diimplementasikan');
        }

        // Print Table
        function printTable() {
            window.print();
        }
    </script>
@endsection
