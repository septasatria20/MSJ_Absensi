<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class TrstukController extends Controller
{
    // Display Tukar Jadwal Page
    public function index($data)
    {
        return view('transc.trstuk.list', $data);
    }

    // Get History List (AJAX with Pagination)
    public function ajax($data = [])
    {
        $page = request()->input('page', 1);
        $perPage = 10;
        $search = request()->input('search', '');

        // Dummy data - nanti akan diganti dengan query database
        $allData = [
            [
                'id' => 1,
                'tanggal_pengajuan' => '2026-01-12',
                'nik_pengaju' => '415597',
                'nama_pengaju' => 'Septa Satria',
                'departemen_pengaju' => 'MIS',
                'shift_asal' => 'pagi',
                'shift_asal_desc' => 'Shift Pagi',
                'nik_ditukar' => '445178',
                'nama_ditukar' => 'Sri Mulyani',
                'departemen_ditukar' => 'MIS',
                'shift_tujuan' => 'malam',
                'shift_tujuan_desc' => 'Shift Malam',
                'tanggal_tukar' => '2026-02-13',
                'alasan' => 'Ada keperluan keluarga mendadak',
                'catatan_admin' => 'Disetujui',
                'status' => 'approved'
            ],
            [
                'id' => 2,
                'tanggal_pengajuan' => '2025-02-21',
                'nik_pengaju' => '416597',
                'nama_pengaju' => 'Dinsya Putra',
                'departemen_pengaju' => 'MIS',
                'shift_asal' => 'siang',
                'shift_asal_desc' => 'Shift Siang',
                'nik_ditukar' => '445174',
                'nama_ditukar' => 'Latif Putri',
                'departemen_ditukar' => 'MIS',
                'shift_tujuan' => 'malam',
                'shift_tujuan_desc' => 'Shift Malam',
                'tanggal_tukar' => '2025-02-22',
                'alasan' => 'Anak sakit perlu dijaga',
                'catatan_admin' => 'Disetujui',
                'status' => 'approved'
            ],
            [
                'id' => 3,
                'tanggal_pengajuan' => '2025-03-22',
                'nik_pengaju' => '415597',
                'nama_pengaju' => 'Prabowo Kusuma',
                'departemen_pengaju' => 'Management',
                'shift_asal' => 'pagi',
                'shift_asal_desc' => 'Shift Pagi',
                'nik_ditukar' => '445178',
                'nama_ditukar' => 'Putra Idzan',
                'departemen_ditukar' => 'Management',
                'shift_tujuan' => 'siang',
                'shift_tujuan_desc' => 'Shift Siang',
                'tanggal_tukar' => '2025-03-24',
                'alasan' => 'Ada acara keluarga',
                'catatan_admin' => 'Pending approval',
                'status' => 'pending'
            ],
            [
                'id' => 4,
                'tanggal_pengajuan' => '2025-04-21',
                'nik_pengaju' => '415597',
                'nama_pengaju' => 'Dilan Sanjaya',
                'departemen_pengaju' => 'Finance',
                'shift_asal' => 'pagi',
                'shift_asal_desc' => 'Shift Pagi',
                'nik_ditukar' => '445178',
                'nama_ditukar' => 'Ahmad Fatih',
                'departemen_ditukar' => 'Finance',
                'shift_tujuan' => 'malam',
                'shift_tujuan_desc' => 'Shift Malam',
                'tanggal_tukar' => '2025-04-23',
                'alasan' => 'Keperluan pribadi',
                'catatan_admin' => 'Disetujui',
                'status' => 'approved'
            ],
            [
                'id' => 5,
                'tanggal_pengajuan' => '2025-04-21',
                'nik_pengaju' => '415597',
                'nama_pengaju' => 'Dilan Sanjaya',
                'departemen_pengaju' => 'Finance',
                'shift_asal' => 'pagi',
                'shift_asal_desc' => 'Shift Pagi',
                'nik_ditukar' => '445178',
                'nama_ditukar' => 'Ahmad Fatih',
                'departemen_ditukar' => 'Finance',
                'shift_tujuan' => 'malam',
                'shift_tujuan_desc' => 'Shift Malam',
                'tanggal_tukar' => '2025-04-23',
                'alasan' => 'Kegiatan sosial',
                'catatan_admin' => '',
                'status' => 'pending'
            ],
            [
                'id' => 6,
                'tanggal_pengajuan' => '2025-05-10',
                'nik_pengaju' => '235578',
                'nama_pengaju' => 'Citra Dewi',
                'departemen_pengaju' => 'Warehouse',
                'shift_asal' => 'malam',
                'shift_asal_desc' => 'Shift Malam',
                'nik_ditukar' => '169987',
                'nama_ditukar' => 'Ahmad Fauzi',
                'departemen_ditukar' => 'Produksi',
                'shift_tujuan' => 'pagi',
                'shift_tujuan_desc' => 'Shift Pagi',
                'tanggal_tukar' => '2025-05-12',
                'alasan' => 'Ingin shift pagi untuk beberapa waktu',
                'catatan_admin' => 'Disetujui dengan catatan',
                'status' => 'approved'
            ],
            [
                'id' => 7,
                'tanggal_pengajuan' => '2025-06-15',
                'nik_pengaju' => '007122',
                'nama_pengaju' => 'Gita Maharani',
                'departemen_pengaju' => 'QC',
                'shift_asal' => 'siang',
                'shift_asal_desc' => 'Shift Siang',
                'nik_ditukar' => '090744',
                'nama_ditukar' => 'Hani Purnomo',
                'departemen_ditukar' => 'QC',
                'shift_tujuan' => 'pagi',
                'shift_tujuan_desc' => 'Shift Pagi',
                'tanggal_tukar' => '2025-06-17',
                'alasan' => 'Penyesuaian jadwal kuliah',
                'catatan_admin' => '',
                'status' => 'pending'
            ],
            [
                'id' => 8,
                'tanggal_pengajuan' => '2025-07-20',
                'nik_pengaju' => '099744',
                'nama_pengaju' => 'Hari Purnomo',
                'departemen_pengaju' => 'Admin',
                'shift_asal' => 'pagi',
                'shift_asal_desc' => 'Shift Pagi',
                'nik_ditukar' => '123456',
                'nama_ditukar' => 'Budi Santoso',
                'departemen_ditukar' => 'Admin',
                'shift_tujuan' => 'siang',
                'shift_tujuan_desc' => 'Shift Siang',
                'tanggal_tukar' => '2025-07-22',
                'alasan' => 'Ada training external',
                'catatan_admin' => 'Ditolak, quota shift sudah penuh',
                'status' => 'rejected'
            ],
        ];

        // Filter by search
        if ($search) {
            $allData = array_filter($allData, function($item) use ($search) {
                return stripos($item['nama_pengaju'], $search) !== false ||
                       stripos($item['nik_pengaju'], $search) !== false ||
                       stripos($item['nama_ditukar'], $search) !== false ||
                       stripos($item['nik_ditukar'], $search) !== false;
            });
        }

        $total = count($allData);
        $lastPage = ceil($total / $perPage);
        $offset = ($page - 1) * $perPage;
        $paginatedData = array_slice($allData, $offset, $perPage);

        return response()->json([
            'success' => true,
            'data' => $paginatedData,
            'pagination' => [
                'current_page' => (int)$page,
                'last_page' => $lastPage,
                'per_page' => $perPage,
                'total' => $total
            ]
        ]);
    }

    // Get Karyawan with Shift Info (AJAX)
    public function getkaryawan($data = [])
    {
        $query = request()->input('query', '');

        // Dummy karyawan data with shift information - comprehensive list untuk testing autocomplete
        $karyawanData = [
            // MIS Department
            ['nik' => '415597', 'nama' => 'Septa Satria', 'departemen' => 'MIS', 'shift' => 'pagi', 'shift_desc' => 'Shift Pagi (07:00 - 15:00)'],
            ['nik' => '416597', 'nama' => 'Dinsya Putra', 'departemen' => 'MIS', 'shift' => 'siang', 'shift_desc' => 'Shift Siang (15:00 - 23:00)'],
            ['nik' => '445174', 'nama' => 'Latif Putri', 'departemen' => 'MIS', 'shift' => 'malam', 'shift_desc' => 'Shift Malam (23:00 - 07:00)'],
            ['nik' => '445178', 'nama' => 'Sri Mulyani', 'departemen' => 'MIS', 'shift' => 'malam', 'shift_desc' => 'Shift Malam (23:00 - 07:00)'],
            
            // Produksi Department
            ['nik' => '169987', 'nama' => 'Ahmad Fauzi', 'departemen' => 'Produksi', 'shift' => 'pagi', 'shift_desc' => 'Shift Pagi (07:00 - 15:00)'],
            ['nik' => '234567', 'nama' => 'Dewi Kusuma', 'departemen' => 'Produksi', 'shift' => 'malam', 'shift_desc' => 'Shift Malam (23:00 - 07:00)'],
            ['nik' => '456789', 'nama' => 'Fajar Nugroho', 'departemen' => 'Produksi', 'shift' => 'siang', 'shift_desc' => 'Shift Siang (15:00 - 23:00)'],
            ['nik' => '567890', 'nama' => 'Indah Permata', 'departemen' => 'Produksi', 'shift' => 'pagi', 'shift_desc' => 'Shift Pagi (07:00 - 15:00)'],
            
            // Warehouse Department
            ['nik' => '235578', 'nama' => 'Citra Dewi', 'departemen' => 'Warehouse', 'shift' => 'malam', 'shift_desc' => 'Shift Malam (23:00 - 07:00)'],
            ['nik' => '345678', 'nama' => 'Eko Prasetyo', 'departemen' => 'Warehouse', 'shift' => 'pagi', 'shift_desc' => 'Shift Pagi (07:00 - 15:00)'],
            ['nik' => '678901', 'nama' => 'Joko Widodo', 'departemen' => 'Warehouse', 'shift' => 'siang', 'shift_desc' => 'Shift Siang (15:00 - 23:00)'],
            ['nik' => '789012', 'nama' => 'Kartika Sari', 'departemen' => 'Warehouse', 'shift' => 'malam', 'shift_desc' => 'Shift Malam (23:00 - 07:00)'],
            
            // QC Department
            ['nik' => '007122', 'nama' => 'Gita Maharani', 'departemen' => 'QC', 'shift' => 'siang', 'shift_desc' => 'Shift Siang (15:00 - 23:00)'],
            ['nik' => '090744', 'nama' => 'Hani Purnomo', 'departemen' => 'QC', 'shift' => 'pagi', 'shift_desc' => 'Shift Pagi (07:00 - 15:00)'],
            ['nik' => '890123', 'nama' => 'Linda Wijaya', 'departemen' => 'QC', 'shift' => 'malam', 'shift_desc' => 'Shift Malam (23:00 - 07:00)'],
            ['nik' => '901234', 'nama' => 'Mega Putri', 'departemen' => 'QC', 'shift' => 'pagi', 'shift_desc' => 'Shift Pagi (07:00 - 15:00)'],
            
            // Admin Department
            ['nik' => '099744', 'nama' => 'Hari Purnomo', 'departemen' => 'Admin', 'shift' => 'pagi', 'shift_desc' => 'Shift Pagi (07:00 - 15:00)'],
            ['nik' => '123456', 'nama' => 'Budi Santoso', 'departemen' => 'Admin', 'shift' => 'siang', 'shift_desc' => 'Shift Siang (15:00 - 23:00)'],
            ['nik' => '012345', 'nama' => 'Nina Kusuma', 'departemen' => 'Admin', 'shift' => 'pagi', 'shift_desc' => 'Shift Pagi (07:00 - 15:00)'],
            ['nik' => '112233', 'nama' => 'Oki Setiawan', 'departemen' => 'Admin', 'shift' => 'siang', 'shift_desc' => 'Shift Siang (15:00 - 23:00)'],
            
            // Finance Department
            ['nik' => '223344', 'nama' => 'Puspita Dewi', 'departemen' => 'Finance', 'shift' => 'pagi', 'shift_desc' => 'Shift Pagi (07:00 - 15:00)'],
            ['nik' => '334455', 'nama' => 'Qori Rahayu', 'departemen' => 'Finance', 'shift' => 'siang', 'shift_desc' => 'Shift Siang (15:00 - 23:00)'],
            ['nik' => '445566', 'nama' => 'Rizki Pratama', 'departemen' => 'Finance', 'shift' => 'pagi', 'shift_desc' => 'Shift Pagi (07:00 - 15:00)'],
            
            // Management Department
            ['nik' => '556677', 'nama' => 'Siti Nurhaliza', 'departemen' => 'Management', 'shift' => 'pagi', 'shift_desc' => 'Shift Pagi (07:00 - 15:00)'],
            ['nik' => '667788', 'nama' => 'Tono Sumarno', 'departemen' => 'Management', 'shift' => 'siang', 'shift_desc' => 'Shift Siang (15:00 - 23:00)'],
            ['nik' => '778899', 'nama' => 'Udin Setiawan', 'departemen' => 'Management', 'shift' => 'pagi', 'shift_desc' => 'Shift Pagi (07:00 - 15:00)'],
            
            // HR Department
            ['nik' => '998877', 'nama' => 'Vera Anggraini', 'departemen' => 'HR', 'shift' => 'pagi', 'shift_desc' => 'Shift Pagi (07:00 - 15:00)'],
            ['nik' => '887766', 'nama' => 'Wawan Junaidi', 'departemen' => 'HR', 'shift' => 'siang', 'shift_desc' => 'Shift Siang (15:00 - 23:00)'],
            ['nik' => '776655', 'nama' => 'Xena Wijaya', 'departemen' => 'HR', 'shift' => 'pagi', 'shift_desc' => 'Shift Pagi (07:00 - 15:00)'],
            
            // Marketing Department
            ['nik' => '665544', 'nama' => 'Yoga Pratama', 'departemen' => 'Marketing', 'shift' => 'pagi', 'shift_desc' => 'Shift Pagi (07:00 - 15:00)'],
            ['nik' => '554433', 'nama' => 'Zahra Amelia', 'departemen' => 'Marketing', 'shift' => 'siang', 'shift_desc' => 'Shift Siang (15:00 - 23:00)'],
        ];

        // Filter by query
        if ($query) {
            $filtered = array_filter($karyawanData, function($k) use ($query) {
                return stripos($k['nik'], $query) !== false || 
                       stripos($k['nama'], $query) !== false;
            });
            $karyawanData = array_values($filtered);
        }

        return response()->json([
            'success' => true,
            'data' => $karyawanData
        ]);
    }

    // Store Tukar Jadwal (Submit)
    public function store($data = [])
    {
        // TODO: Validate and save to database
        // For now, just return success response
        
        $tanggal_tukar = request()->input('tanggal_tukar');
        $nik_pengaju = request()->input('nik_pengaju');
        $nik_ditukar = request()->input('nik_ditukar');
        $alasan = request()->input('alasan');
        $catatan_admin = request()->input('catatan_admin');

        return response()->json([
            'success' => true,
            'message' => 'Pengajuan tukar jadwal berhasil disimpan dan menunggu approval'
        ]);
    }

    // Approve/Reject (for admin)
    public function approval($data = [])
    {
        // TODO: Update status in database
        $id = request()->input('id');
        $status = request()->input('status'); // 'approved' or 'rejected'
        $catatan = request()->input('catatan');

        return response()->json([
            'success' => true,
            'message' => 'Status tukar jadwal berhasil diupdate'
        ]);
    }
}
