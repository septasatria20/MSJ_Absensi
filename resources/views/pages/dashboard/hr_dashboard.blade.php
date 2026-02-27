@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => ''])
    <div class="container-fluid py-4">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-1">Dashboard</h6>
                        <p class="text-sm">Dashboard HR MSJ Absensi</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Metrics Row 1 -->
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Data Missing</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ $data_missing ?? 15 }}
                                    </h5>
                                    <p class="mb-0 text-sm">
                                        <span class="text-danger font-weight-bolder">Perlu Dikonfirmasi</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                    <i class="ni ni-bell-55 text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Hadir Hari Ini</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ $hadir_hari_ini ?? 365 }}
                                    </h5>
                                    <p class="mb-0 text-sm">
                                        <span class="text-success font-weight-bolder">91%</span> kehadiran
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="ni ni-check-bold text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Izin/Cuti</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ $izin_cuti ?? 25 }}
                                    </h5>
                                    <p class="mb-0 text-sm">
                                        <span class="text-warning font-weight-bolder">6%</span> dari total
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="ni ni-calendar-grid-58 text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Mangkir/Alpha</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ $mangkir ?? 10 }}
                                    </h5>
                                    <p class="mb-0 text-sm">
                                        <span class="text-danger font-weight-bolder">2.5%</span> dari total
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="ni ni-user-run text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Metrics Row 2 -->
        <div class="row mt-4">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Terlambat</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ $terlambat ?? 42 }}
                                    </h5>
                                    <p class="mb-0 text-sm">
                                        <span class="text-warning font-weight-bolder">10.5%</span> hari ini
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="ni ni-watch-time text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Shift Pagi</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ $shift_pagi ?? 180 }}
                                    </h5>
                                    <p class="mb-0 text-sm">
                                        <span class="text-dark font-weight-bolder">45%</span> karyawan
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="fas fa-sun text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Shift Siang</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ $shift_siang ?? 100 }}
                                    </h5>
                                    <p class="mb-0 text-sm">
                                        <span class="text-dark font-weight-bolder">25%</span> karyawan
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="fas fa-cloud-sun text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Shift Malam</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ $shift_malam ?? 120 }}
                                    </h5>
                                    <p class="mb-0 text-sm">
                                        <span class="text-dark font-weight-bolder">30%</span> karyawan
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="fas fa-moon text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="row mt-4">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card z-index-2 h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h6 class="text-capitalize">Grafik Total Karyawan Hadir</h6>
                        <p class="text-sm mb-0">
                            <i class="fa fa-arrow-up text-success"></i>
                            <span class="font-weight-bold">Tahun 2026</span> - Rekap Per Bulan
                        </p>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="chart-bar-absensi" class="chart-canvas" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h6 class="text-capitalize">Status Kehadiran Hari Ini</h6>
                        <p class="text-sm mb-0">Distribusi status karyawan</p>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="chart-pie-status" class="chart-canvas" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kalender Libur -->
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-2">Kalender Cuti Bersama - Tahun {{ date('Y') }}</h6>
                        <p class="text-sm mb-0">Deskripsi libur cuti bersama akan ditampilkan ketika Anda mengklik tanggal.</p>
                    </div>
                    <div class="card-body p-3">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Pilih Bulan</label>
                                <select class="form-select" id="bulanLibur">
                                    <option value="1" {{ date('n') == 1 ? 'selected' : '' }}>Januari</option>
                                    <option value="2" {{ date('n') == 2 ? 'selected' : '' }}>Februari</option>
                                    <option value="3" {{ date('n') == 3 ? 'selected' : '' }}>Maret</option>
                                    <option value="4" {{ date('n') == 4 ? 'selected' : '' }}>April</option>
                                    <option value="5" {{ date('n') == 5 ? 'selected' : '' }}>Mei</option>
                                    <option value="6" {{ date('n') == 6 ? 'selected' : '' }}>Juni</option>
                                    <option value="7" {{ date('n') == 7 ? 'selected' : '' }}>Juli</option>
                                    <option value="8" {{ date('n') == 8 ? 'selected' : '' }}>Agustus</option>
                                    <option value="9" {{ date('n') == 9 ? 'selected' : '' }}>September</option>
                                    <option value="10" {{ date('n') == 10 ? 'selected' : '' }}>Oktober</option>
                                    <option value="11" {{ date('n') == 11 ? 'selected' : '' }}>November</option>
                                    <option value="12" {{ date('n') == 12 ? 'selected' : '' }}>Desember</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Pilih Tahun</label>
                                <select class="form-select" id="tahunLibur">
                                    <option value="2025">2025</option>
                                    <option value="2026" selected>2026</option>
                                    <option value="2027">2027</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="kalenderLibur">
                                <thead style="background-color: #0A9294; color: white;">
                                    <tr>
                                        <th style="color: #0A9294; background-color: #E0F7F7;">Min</th>
                                        <th style="color: #0A9294; background-color: #E0F7F7;">Sen</th>
                                        <th style="color: #0A9294; background-color: #E0F7F7;">Sel</th>
                                        <th style="color: #0A9294; background-color: #E0F7F7;">Rab</th>
                                        <th style="color: #0A9294; background-color: #E0F7F7;">Kam</th>
                                        <th style="color: #0A9294; background-color: #E0F7F7;">Jum</th>
                                        <th style="color: #0A9294; background-color: #E0F7F7;">Sab</th>
                                    </tr>
                                </thead>
                                <tbody id="kalenderBody">
                                    <!-- Calendar will be generated by JavaScript -->
                                </tbody>
                            </table>
                        </div>
                        
                        <div id="liburInfo" class="mt-3" style="display: none;">
                            <div class="alert alert-info mb-0">
                                <strong>Libur:</strong> <span id="liburDesc"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Row -->
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">Absensi Per Departemen Hari Ini</h6>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Departemen</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Jumlah</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Hadir</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Izin/Cuti</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Alpha</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">%</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Engineering</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold">120</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold text-success">115</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold text-warning">3</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold text-danger">2</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold">95.8%</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Finance</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold">25</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold text-success">24</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold text-warning">1</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold text-danger">0</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold">96%</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">HRD</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold">18</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold text-success">18</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold text-warning">0</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold text-danger">0</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold">100%</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Jishuken</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold">35</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold text-success">33</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold text-warning">1</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold text-danger">1</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold">94.3%</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Management</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold">12</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold text-success">12</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold text-warning">0</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold text-danger">0</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold">100%</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">MIS</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold">22</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold text-success">21</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold text-warning">1</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold text-danger">0</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold">95.5%</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="./assets/js/plugins/chartjs.min.js"></script>
    <script>
        // Data Hari Libur Non-Shift dari database
        const hariLibur = {!! json_encode($hari_libur ?? []) !!};

        function generateCalendar(bulan, tahun) {
            const firstDay = new Date(tahun, bulan - 1, 1);
            const lastDay = new Date(tahun, bulan, 0);
            const daysInMonth = lastDay.getDate();
            const startDayOfWeek = firstDay.getDay(); // 0 = Sunday, 1 = Monday, etc.
            
            let html = '<tr>';
            
            // Fill empty cells before first day
            for (let i = 0; i < startDayOfWeek; i++) {
                html += '<td style="background-color: #f8f9fa; height: 80px;"></td>';
            }
            
            // Fill days
            let currentDay = startDayOfWeek;
            for (let day = 1; day <= daysInMonth; day++) {
                if (currentDay === 7) {
                    html += '</tr><tr>';
                    currentDay = 0;
                }
                
                const dateStr = `${tahun}-${String(bulan).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                const isLibur = hariLibur[dateStr];
                const isToday = dateStr === '{{ date("Y-m-d") }}';
                
                let cellStyle = 'height: 80px; vertical-align: middle; cursor: pointer; position: relative;';
                let cellClass = '';
                
                if (isLibur) {
                    cellStyle += ' background-color: #ffebee; border: 2px solid #f44336;';
                    cellClass = 'libur-cell';
                } else if (isToday) {
                    cellStyle += ' border: 3px solid #0A9294; background-color: #E0F7F7;';
                }
                
                html += `<td style="${cellStyle}" class="${cellClass}" data-date="${dateStr}" data-libur="${isLibur || ''}" onclick="showLiburInfo('${dateStr}', '${isLibur || ''}')">
                    <strong style="font-size: 16px;">${day}</strong>
                    ${isLibur ? '<br><span style="color: #f44336; font-size: 10px;">●</span>' : ''}
                </td>`;
                
                currentDay++;
            }
            
            // Fill empty cells after last day
            while (currentDay < 7 && currentDay > 0) {
                html += '<td style="background-color: #f8f9fa; height: 80px;"></td>';
                currentDay++;
            }
            
            html += '</tr>';
            
            document.getElementById('kalenderBody').innerHTML = html;
        }
        
        function showLiburInfo(dateStr, desc) {
            if (desc) {
                document.getElementById('liburDesc').textContent = desc;
                document.getElementById('liburInfo').style.display = 'block';
            } else {
                document.getElementById('liburInfo').style.display = 'none';
            }
        }
        
        // Initialize calendar
        generateCalendar({{ date('n') }}, {{ date('Y') }});
        
        // Event listeners for month/year changes
        document.getElementById('bulanLibur').addEventListener('change', function() {
            const bulan = parseInt(this.value);
            const tahun = parseInt(document.getElementById('tahunLibur').value);
            generateCalendar(bulan, tahun);
        });
        
        document.getElementById('tahunLibur').addEventListener('change', function() {
            const tahun = parseInt(this.value);
            const bulan = parseInt(document.getElementById('bulanLibur').value);
            generateCalendar(bulan, tahun);
        });
    </script>
    <script>
        // Bar Chart - Rekap Absensi Per Bulan
        var ctxBar = document.getElementById("chart-bar-absensi").getContext("2d");
        
        new Chart(ctxBar, {
            type: "bar",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agt", "Sep", "Okt", "Nov", "Des"],
                datasets: [{
                    label: "Hadir",
                    backgroundColor: "#0A9294",
                    data: [350, 340, 365, 355, 370, 360, 365, 358, 362, 368, 0, 0],
                    maxBarThickness: 40
                }, {
                    label: "Izin/Cuti",
                    backgroundColor: "#f5365c",
                    data: [30, 35, 25, 30, 20, 25, 22, 28, 25, 20, 0, 0],
                    maxBarThickness: 40
                }, {
                    label: "Alpha",
                    backgroundColor: "#fb6340",
                    data: [20, 25, 10, 15, 10, 15, 13, 14, 13, 12, 0, 0],
                    maxBarThickness: 40
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#9ca2b7',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            display: true,
                            color: '#9ca2b7',
                            padding: 10,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });

        // Pie Chart - Status Kehadiran
        var ctxPie = document.getElementById("chart-pie-status").getContext("2d");
        
        new Chart(ctxPie, {
            type: "doughnut",
            data: {
                labels: ["Hadir", "Izin/Cuti", "Alpha", "Terlambat"],
                datasets: [{
                    label: "Status",
                    backgroundColor: ["#0A9294", "#66BB6A", "#fb6340", "#ffd600"],
                    data: [365, 25, 10, 42],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            padding: 15,
                            boxWidth: 15,
                            font: {
                                size: 12,
                                family: "Open Sans"
                            }
                        }
                    }
                },
                cutout: '70%'
            },
        });
    </script>
@endpush
