@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => $title ?? ''])

    <div class="container-fluid py-3">
        <div class="card shadow-sm mb-4">
            <div class="card-body p-3 pb-2">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div>
                        <h6 class="mb-1 text-dark font-weight-bold">Detail SP Karyawan</h6>
                        <p class="text-sm text-secondary mb-0">{{ $sp['nik'] }} - {{ $sp['nama'] }} ({{ $sp['departemen'] }})</p>
                    </div>
                    <a href="{{ url('/trssp') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>Kembali ke Kirim SP
                    </a>
                </div>
            </div>

            <div class="px-3 pb-2 d-flex flex-column align-items-start gap-2" id="detailActionBar">
                <div id="detailSpExportButtons" class="d-flex gap-2 flex-wrap justify-content-start"></div>
            </div>

            <div class="pb-3 px-3">
                <div class="table-responsive table-wrap-centered">
                    <table class="table table-hover align-items-center mb-0" id="detailSpTable">
                        <thead style="background-color: #00b7bd4f;">
                            <tr>
                                <th class="text-secondary text-sm font-weight-bold opacity-7 text-start" style="width: 36px;">
                                    <input type="checkbox" disabled>
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detailRows as $index => $row)
                                @php
                                    $statusClass = 'bg-gradient-secondary';
                                    if ($row['status'] === 'BELUM FINGER OUT' || $row['status'] === 'BELUM FINGER IN') $statusClass = 'bg-gradient-danger';
                                    if ($row['status'] === 'TERLAMBAT' || $row['status'] === 'PULANG CEPAT') $statusClass = 'bg-gradient-warning';
                                    if ($row['status'] === 'DATA TIDAK ADA') $statusClass = 'bg-gradient-info';
                                @endphp
                                <tr class="{{ $index === 2 ? 'hris-fill' : '' }}">
                                    <td><input type="checkbox" disabled></td>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $row['tanggal'] }}</td>
                                    <td><strong>{{ $sp['nik'] }}</strong></td>
                                    <td>{{ $sp['nama'] }}</td>
                                    <td>{{ $row['shift'] }}</td>
                                    <td>{!! $row['jam_masuk'] ? $row['jam_masuk'] : '<span class="badge badge-sm bg-gradient-danger">MISSING</span>' !!}</td>
                                    <td>{{ $row['terlambat'] }}</td>
                                    <td>{!! $row['jam_keluar'] ? $row['jam_keluar'] : '<span class="badge badge-sm bg-gradient-danger">MISSING</span>' !!}</td>
                                    <td>{{ $row['pulang_cepat'] }}</td>
                                    <td><span class="badge badge-sm {{ $statusClass }}">{{ $row['status'] }}</span></td>
                                    <td>{{ $row['keterangan'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <style>
        .hris-fill {
            background-color: #78cedf !important;
        }
        .hris-fill td {
            color: #2f3f5f;
        }
        .table-wrap-centered,
        #detailSpTable_wrapper {
            max-width: 100%;
            margin: 0;
        }
        .detail-note {
            color: #df3f89;
            font-weight: 500;
        }
        .detail-note-dot {
            color: #21b8d7;
            font-size: 1.35rem;
            line-height: 1;
            vertical-align: middle;
            margin: 0 4px;
        }
    </style>
    <script>
        let detailSpTable = null;

        function styleDetailButtons() {
            $('#detailSpExportButtons .dt-button').addClass('btn btn-secondary');
            $('#detailSpExportButtons .dt-button').removeClass('dt-button');
        }

        $(document).ready(function() {
            detailSpTable = $('#detailSpTable').DataTable({
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
                        sheetName: 'Detail SP Karyawan',
                        exportOptions: { columns: ':visible:not(:first-child)' }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf me-1 text-lg text-danger"></i><span class="font-weight-bold"> PDF',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        exportOptions: { columns: ':visible:not(:first-child)' }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print me-1 text-lg text-info"></i><span class="font-weight-bold"> Print',
                        exportOptions: { columns: ':visible:not(:first-child)' }
                    }
                ]
            });

            detailSpTable.buttons().container().appendTo('#detailSpExportButtons');
            styleDetailButtons();
        });
    </script>
    @endpush
@endsection
