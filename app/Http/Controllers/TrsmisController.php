<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrsmisController extends Controller
{
    /**
     * Display Data Missing page
     */
    public function index($data)
    {
        // TODO: Nanti akan ambil data dari database
        // Untuk sekarang fokus UI dulu
        
        return view($data['url'], $data);
    }
    
    /**
     * Get Data Missing data via AJAX
     */
    public function ajax($data)
    {
        // Get filter parameters using global request() helper
        $tanggalMulai = request()->input('tanggal_mulai');
        $tanggalAkhir = request()->input('tanggal_akhir');
        $filterKaryawan = request()->input('karyawan');
        
        // All dummy data
        $allDummyData = [
            [
                'id' => 1,
                'tanggal' => '2026-02-12',
                'nik' => '169987',
                'nama' => 'Ahmad Fauzi',
                'shift' => 'Shift Pagi',
                'jam_masuk' => '07:05',
                'terlambat' => '00:05',
                'jam_keluar' => '',
                'pulang_cepat' => '',
                'status' => 'Belum Finger Out',
                'status_badge' => 'danger',
                'keterangan' => 'Izin Pulang Cepat',
                'keterangan_badge' => 'success'
            ],
            [
                'id' => 2,
                'tanggal' => '2026-02-11',
                'nik' => '235578',
                'nama' => 'Citra Dewi',
                'shift' => 'Shift Siang',
                'jam_masuk' => '',
                'terlambat' => '',
                'jam_keluar' => '16:05',
                'pulang_cepat' => '',
                'status' => 'Belum Finger In',
                'status_badge' => 'danger',
                'keterangan' => 'Mangkir/Tanpa Keterangan',
                'keterangan_badge' => 'danger'
            ],
            [
                'id' => 3,
                'tanggal' => '2026-02-10',
                'nik' => '007122',
                'nama' => 'Gita Maharani',
                'shift' => 'Shift Malam',
                'jam_masuk' => '',
                'terlambat' => '',
                'jam_keluar' => '',
                'pulang_cepat' => '',
                'status' => 'Data Tidak Ada',
                'status_badge' => 'secondary',
                'keterangan' => 'Cuti Tahunan',
                'keterangan_badge' => 'info'
            ],
            [
                'id' => 4,
                'tanggal' => '2026-02-09',
                'nik' => '090744',
                'nama' => 'Hani Purnomo',
                'shift' => 'Shift Pagi',
                'jam_masuk' => '07:15',
                'terlambat' => '00:05',
                'jam_keluar' => '17:00',
                'pulang_cepat' => '',
                'status' => 'Terlambat',
                'status_badge' => 'warning',
                'keterangan' => 'Sakit',
                'keterangan_badge' => 'info'
            ],
            [
                'id' => 5,
                'tanggal' => '2026-02-09',
                'nik' => '099744',
                'nama' => 'Hari Purnomo',
                'shift' => 'Shift Pagi',
                'jam_masuk' => '07:10',
                'terlambat' => '00:10',
                'jam_keluar' => '15:30',
                'pulang_cepat' => '01:30',
                'status' => 'Pulang Cepat',
                'status_badge' => 'warning',
                'keterangan' => 'Sakit',
                'keterangan_badge' => 'info'
            ],
            [
                'id' => 6,
                'tanggal' => '2026-02-09',
                'nik' => '099744',
                'nama' => 'Hari Purnomo',
                'shift' => 'Shift Pagi',
                'jam_masuk' => '07:15',
                'terlambat' => '00:05',
                'jam_keluar' => '16:00',
                'pulang_cepat' => '01:00',
                'status' => 'Terlambat',
                'status_badge' => 'warning',
                'keterangan' => 'Sakit',
                'keterangan_badge' => 'info'
            ],
            [
                'id' => 7,
                'tanggal' => '2026-02-09',
                'nik' => '099744',
                'nama' => 'Hari Purnomo',
                'shift' => 'Shift Pagi',
                'jam_masuk' => '07:10',
                'terlambat' => '00:10',
                'jam_keluar' => '',
                'pulang_cepat' => '',
                'status' => 'Belum Finger Out',
                'status_badge' => 'danger',
                'keterangan' => 'Mangkir/Tanpa Keterangan',
                'keterangan_badge' => 'danger'
            ],
            // Januari data
            [
                'id' => 8,
                'tanggal' => '2026-01-25',
                'nik' => '169987',
                'nama' => 'Ahmad Fauzi',
                'shift' => 'Shift Pagi',
                'jam_masuk' => '07:20',
                'terlambat' => '00:10',
                'jam_keluar' => '16:30',
                'pulang_cepat' => '',
                'status' => 'Terlambat',
                'status_badge' => 'warning',
                'keterangan' => 'Izin Pulang Cepat',
                'keterangan_badge' => 'success'
            ],
            [
                'id' => 9,
                'tanggal' => '2026-01-20',
                'nik' => '235578',
                'nama' => 'Citra Dewi',
                'shift' => 'Shift Siang',
                'jam_masuk' => '',
                'terlambat' => '',
                'jam_keluar' => '',
                'pulang_cepat' => '',
                'status' => 'Data Tidak Ada',
                'status_badge' => 'secondary',
                'keterangan' => 'Cuti Tahunan',
                'keterangan_badge' => 'info'
            ],
            [
                'id' => 10,
                'tanggal' => '2026-01-15',
                'nik' => '007122',
                'nama' => 'Gita Maharani',
                'shift' => 'Shift Malam',
                'jam_masuk' => '23:05',
                'terlambat' => '',
                'jam_keluar' => '05:30',
                'pulang_cepat' => '02:00',
                'status' => 'Pulang Cepat',
                'status_badge' => 'warning',
                'keterangan' => 'Sakit',
                'keterangan_badge' => 'info'
            ]
        ];
        
        // Apply filters by date range
        if (!empty($tanggalMulai) && !empty($tanggalAkhir)) {
            $filteredData = array_filter($allDummyData, function($item) use ($tanggalMulai, $tanggalAkhir) {
                return isset($item['tanggal']) && 
                       $item['tanggal'] >= $tanggalMulai && 
                       $item['tanggal'] <= $tanggalAkhir;
            });
        } else {
            $filteredData = $allDummyData;
        }
        
        // Filter by karyawan NIK (optional)
        if (!empty($filterKaryawan)) {
            $filteredData = array_filter($filteredData, function($item) use ($filterKaryawan) {
                return isset($item['nik']) && $item['nik'] === $filterKaryawan;
            });
        }
        
        // Reset array keys
        $filteredData = array_values($filteredData);
        
        return response()->json([
            'success' => true,
            'data' => $filteredData,
            'total' => count($filteredData),
            'filters' => [
                'tanggal_mulai' => $tanggalMulai,
                'tanggal_akhir' => $tanggalAkhir,
                'karyawan' => $filterKaryawan ?: 'Semua'
            ]
        ]);
    }
    
    /**
     * Update keterangan for selected records
     */
    public function konfirmasi($data)
    {
        $ids = request()->input('ids', []);
        
        if (empty($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada data yang dipilih'
            ], 400);
        }
        
        // TODO: Update database trs_data_missing
        // For now return dummy success
        
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dikonfirmasi',
            'confirmed' => count($ids)
        ]);
    }
    
    /**
     * Update keterangan for single record
     */
    public function updateketerangan($data)
    {
        $id = request()->input('id');
        $keterangan = request()->input('keterangan');
        
        // TODO: Update database trs_data_missing
        // For now return dummy success
        
        return response()->json([
            'success' => true,
            'message' => 'Keterangan berhasil diupdate'
        ]);
    }
}
