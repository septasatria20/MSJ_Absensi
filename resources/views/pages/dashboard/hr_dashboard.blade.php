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
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Jumlah Karyawan</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ $total_karyawan ?? 400 }}
                                    </h5>
                                    <p class="mb-0 text-sm">
                                        <span class="text-success font-weight-bolder">Aktif</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
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
                                    <i class="ni ni-sun-fog-29 text-lg opacity-10" aria-hidden="true"></i>
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
                                    <i class="ni ni-planet text-lg opacity-10" aria-hidden="true"></i>
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
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Non Shift</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ $non_shift ?? 100 }}
                                    </h5>
                                    <p class="mb-0 text-sm">
                                        <span class="text-dark font-weight-bolder">25%</span> karyawan
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="ni ni-briefcase-24 text-lg opacity-10" aria-hidden="true"></i>
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
                                                <h6 class="mb-0 text-sm">Production</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold">250</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold text-success">235</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold text-warning">10</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold text-danger">5</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold">94%</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Quality Control</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold">80</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold text-success">75</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold text-warning">3</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold text-danger">2</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold">93.75%</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Warehouse</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold">40</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold text-success">38</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold text-warning">2</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold text-danger">0</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold">95%</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Office</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold">30</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold text-success">27</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold text-warning">2</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold text-danger">1</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-sm font-weight-bold">90%</span>
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
