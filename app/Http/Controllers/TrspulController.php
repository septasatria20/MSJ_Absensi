<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrspulController extends Controller
{
    /**
     * Display Pull Finger page
     */
    public function index($data)
    {
        // TODO: Nanti akan ambil data dari database FTM (terpisah)
        // Untuk sekarang fokus UI dulu
        
        return view($data['url'], $data);
    }
    
    /**
     * Get Pull Finger data via AJAX
     */
    public function ajax($data)
    {
        // TODO: Nanti akan query ke database FTM (terpisah)
        // Return dummy data untuk testing UI sesuai format table
        
        // Get filter parameters using global request() helper
        $filterBulan = request()->input('bulan');
        $filterDepartemen = request()->input('departemen');
        $filterKaryawan = request()->input('karyawan');
        
        // All dummy data
        $allDummyData = [
            [
                'id_pull' => 1,
                'tanggal_pull' => '03/02/2026',
                'shift_code' => 'S1c',
                'shift_name' => 'Shift 1c',
                'nik' => '001',
                'nama' => 'Ahmad Budiman',
                'departemen' => 'produksi',
                'bulan' => '2026-02',
                'jam_masuk' => '07:30',
                'scan_masuk' => '07:26',
                'jam_keluar' => '15:30',
                'scan_keluar' => '16:03',
                'istirahat1_masuk' => '11:00',
                'istirahat1_keluar' => '11:22',
                'istirahat2_masuk' => '',
                'istirahat2_keluar' => '',
                'durasi' => '08:15'
            ],
            [
                'id_pull' => 2,
                'tanggal_pull' => '04/02/2026',
                'shift_code' => 'S2c',
                'shift_name' => 'Shift 2b',
                'nik' => '002',
                'nama' => 'Siti Nurhaliza',
                'departemen' => 'admin',
                'bulan' => '2026-02',
                'jam_masuk' => '15:30',
                'scan_masuk' => '15:19',
                'jam_keluar' => '23:30',
                'scan_keluar' => '23:30',
                'istirahat1_masuk' => '17:51',
                'istirahat1_keluar' => '18:13',
                'istirahat2_masuk' => '21:22',
                'istirahat2_keluar' => '21:35',
                'durasi' => '07:38'
            ],
            [
                'id_pull' => 3,
                'tanggal_pull' => '05/02/2026',
                'shift_code' => 'S1c',
                'shift_name' => 'Shift 1c',
                'nik' => '003',
                'nama' => 'Budi Santoso',
                'departemen' => 'admin',
                'bulan' => '2026-02',
                'jam_masuk' => '07:30',
                'scan_masuk' => '07:24',
                'jam_keluar' => '15:30',
                'scan_keluar' => '15:32',
                'istirahat1_masuk' => '11:04',
                'istirahat1_keluar' => '11:38',
                'istirahat2_masuk' => '',
                'istirahat2_keluar' => '',
                'durasi' => '07:46'
            ],
            [
                'id_pull' => 4,
                'tanggal_pull' => '06/02/2026',
                'shift_code' => 'S3c',
                'shift_name' => 'Shift 3b',
                'nik' => '004',
                'nama' => 'Dewi Kusuma',
                'departemen' => 'warehouse',
                'bulan' => '2026-02',
                'jam_masuk' => '23:30',
                'scan_masuk' => '23:23',
                'jam_keluar' => '07:30',
                'scan_keluar' => '07:35',
                'istirahat1_masuk' => '02:33',
                'istirahat1_keluar' => '02:59',
                'istirahat2_masuk' => '',
                'istirahat2_keluar' => '',
                'durasi' => '07:46'
            ],
            [
                'id_pull' => 5,
                'tanggal_pull' => '07/02/2026',
                'shift_code' => 'S2c',
                'shift_name' => 'Shift 2b',
                'nik' => '005',
                'nama' => 'Eko Prasetyo',
                'departemen' => 'qc',
                'bulan' => '2026-02',
                'jam_masuk' => '15:30',
                'scan_masuk' => '15:25',
                'jam_keluar' => '23:30',
                'scan_keluar' => '23:32',
                'istirahat1_masuk' => '17:36',
                'istirahat1_keluar' => '18:07',
                'istirahat2_masuk' => '21:31',
                'istirahat2_keluar' => '21:42',
                'durasi' => '07:36'
            ],
            [
                'id_pull' => 6,
                'tanggal_pull' => '10/02/2026',
                'shift_code' => 'S1c',
                'shift_name' => 'Shift 1c',
                'nik' => '006',
                'nama' => 'Fitri Handayani',
                'departemen' => 'qc',
                'bulan' => '2026-02',
                'jam_masuk' => '07:30',
                'scan_masuk' => '07:27',
                'jam_keluar' => '15:30',
                'scan_keluar' => '15:31',
                'istirahat1_masuk' => '11:24',
                'istirahat1_keluar' => '11:56',
                'istirahat2_masuk' => '',
                'istirahat2_keluar' => '',
                'durasi' => '07:39'
            ],
            [
                'id_pull' => 7,
                'tanggal_pull' => '11/02/2026',
                'shift_code' => 'S1c',
                'shift_name' => 'Shift 1c',
                'nik' => '007',
                'nama' => 'Gunawan Wibowo',
                'departemen' => 'produksi',
                'bulan' => '2026-02',
                'jam_masuk' => '07:30',
                'scan_masuk' => '06:46',
                'jam_keluar' => '15:30',
                'scan_keluar' => '15:31',
                'istirahat1_masuk' => '11:00',
                'istirahat1_keluar' => '11:31',
                'istirahat2_masuk' => '',
                'istirahat2_keluar' => '',
                'durasi' => '08:14'
            ],
            [
                'id_pull' => 8,
                'tanggal_pull' => '12/02/2026',
                'shift_code' => 'S2c',
                'shift_name' => 'Shift 2b',
                'nik' => '008',
                'nama' => 'Hani Rahmawati',
                'departemen' => 'warehouse',
                'bulan' => '2026-02',
                'jam_masuk' => '15:30',
                'scan_masuk' => '15:26',
                'jam_keluar' => '23:30',
                'scan_keluar' => '23:34',
                'istirahat1_masuk' => '18:32',
                'istirahat1_keluar' => '19:06',
                'istirahat2_masuk' => '21:34',
                'istirahat2_keluar' => '21:48',
                'durasi' => '07:32'
            ],
            // Januari 2026
            [
                'id_pull' => 9,
                'tanggal_pull' => '15/01/2026',
                'shift_code' => 'S1c',
                'shift_name' => 'Shift 1c',
                'nik' => '001',
                'nama' => 'Ahmad Budiman',
                'departemen' => 'produksi',
                'bulan' => '2026-01',
                'jam_masuk' => '07:30',
                'scan_masuk' => '07:28',
                'jam_keluar' => '15:30',
                'scan_keluar' => '15:35',
                'istirahat1_masuk' => '11:05',
                'istirahat1_keluar' => '11:30',
                'istirahat2_masuk' => '',
                'istirahat2_keluar' => '',
                'durasi' => '08:02'
            ],
            [
                'id_pull' => 10,
                'tanggal_pull' => '16/01/2026',
                'shift_code' => 'S2c',
                'shift_name' => 'Shift 2b',
                'nik' => '005',
                'nama' => 'Eko Prasetyo',
                'departemen' => 'qc',
                'bulan' => '2026-01',
                'jam_masuk' => '15:30',
                'scan_masuk' => '15:20',
                'jam_keluar' => '23:30',
                'scan_keluar' => '23:28',
                'istirahat1_masuk' => '17:40',
                'istirahat1_keluar' => '18:10',
                'istirahat2_masuk' => '21:25',
                'istirahat2_keluar' => '21:40',
                'durasi' => '07:38'
            ],
            // Maret 2026
            [
                'id_pull' => 11,
                'tanggal_pull' => '05/03/2026',
                'shift_code' => 'S1c',
                'shift_name' => 'Shift 1c',
                'nik' => '003',
                'nama' => 'Budi Santoso',
                'departemen' => 'admin',
                'bulan' => '2026-03',
                'jam_masuk' => '07:30',
                'scan_masuk' => '07:22',
                'jam_keluar' => '15:30',
                'scan_keluar' => '15:33',
                'istirahat1_masuk' => '11:10',
                'istirahat1_keluar' => '11:42',
                'istirahat2_masuk' => '',
                'istirahat2_keluar' => '',
                'durasi' => '07:51'
            ],
            [
                'id_pull' => 12,
                'tanggal_pull' => '08/03/2026',
                'shift_code' => 'S3c',
                'shift_name' => 'Shift 3b',
                'nik' => '004',
                'nama' => 'Dewi Kusuma',
                'departemen' => 'warehouse',
                'bulan' => '2026-03',
                'jam_masuk' => '23:30',
                'scan_masuk' => '23:25',
                'jam_keluar' => '07:30',
                'scan_keluar' => '07:32',
                'istirahat1_masuk' => '02:35',
                'istirahat1_keluar' => '03:00',
                'istirahat2_masuk' => '',
                'istirahat2_keluar' => '',
                'durasi' => '07:42'
            ],
            // Tambahan Februari
            [
                'id_pull' => 13,
                'tanggal_pull' => '15/02/2026',
                'shift_code' => 'S1c',
                'shift_name' => 'Shift 1c',
                'nik' => '006',
                'nama' => 'Fitri Handayani',
                'departemen' => 'qc',
                'bulan' => '2026-02',
                'jam_masuk' => '07:30',
                'scan_masuk' => '07:32',
                'jam_keluar' => '15:30',
                'scan_keluar' => '15:29',
                'istirahat1_masuk' => '11:15',
                'istirahat1_keluar' => '11:50',
                'istirahat2_masuk' => '',
                'istirahat2_keluar' => '',
                'durasi' => '07:47'
            ],
            [
                'id_pull' => 14,
                'tanggal_pull' => '18/02/2026',
                'shift_code' => 'S2c',
                'shift_name' => 'Shift 2b',
                'nik' => '002',
                'nama' => 'Siti Nurhaliza',
                'departemen' => 'admin',
                'bulan' => '2026-02',
                'jam_masuk' => '15:30',
                'scan_masuk' => '15:18',
                'jam_keluar' => '23:30',
                'scan_keluar' => '23:31',
                'istirahat1_masuk' => '17:50',
                'istirahat1_keluar' => '18:15',
                'istirahat2_masuk' => '21:20',
                'istirahat2_keluar' => '21:33',
                'durasi' => '07:43'
            ],
            [
                'id_pull' => 15,
                'tanggal_pull' => '20/02/2026',
                'shift_code' => 'S1c',
                'shift_name' => 'Shift 1c',
                'nik' => '007',
                'nama' => 'Gunawan Wibowo',
                'departemen' => 'produksi',
                'bulan' => '2026-02',
                'jam_masuk' => '07:30',
                'scan_masuk' => '06:50',
                'jam_keluar' => '15:30',
                'scan_keluar' => '15:28',
                'istirahat1_masuk' => '11:02',
                'istirahat1_keluar' => '11:35',
                'istirahat2_masuk' => '',
                'istirahat2_keluar' => '',
                'durasi' => '08:13'
            ]
        ];
        
        // Apply filters
        $filteredData = $allDummyData;
        
        // Filter by bulan (optional)
        if (!empty($filterBulan)) {
            $filteredData = array_filter($filteredData, function($item) use ($filterBulan) {
                return isset($item['bulan']) && $item['bulan'] === $filterBulan;
            });
        }
        
        // Filter by departemen (optional)
        if (!empty($filterDepartemen)) {
            $filteredData = array_filter($filteredData, function($item) use ($filterDepartemen) {
                return isset($item['departemen']) && $item['departemen'] === $filterDepartemen;
            });
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
                'bulan' => $filterBulan ?: 'Semua',
                'departemen' => $filterDepartemen ?: 'Semua',
                'karyawan' => $filterKaryawan ?: 'Semua'
            ]
        ]);
    }
    
    /**
     * Pull data from FTM Device
     */
    public function pulldevice($data)
    {
        // TODO: Implement FTM/Fingerspot API integration
        // For now, return dummy success
        
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil di-pull dari device',
            'total_records' => 150
        ]);
    }
    
    /**
     * Confirm selected Pull Finger records
     */
    public function konfirmasi($data)
    {
        $ids = request()->input('ids', []);
        
        if (empty($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada data yang dipilih'
            ]);
        }
        
        // Update status to confirmed
        DB::table('trs_pull_finger')
            ->whereIn('id_pull', $ids)
            ->update([
                'status' => 'confirmed',
                'updated_at' => now()
            ]);
        
        return response()->json([
            'success' => true,
            'message' => count($ids) . ' data berhasil dikonfirmasi'
        ]);
    }
    
    /**
     * Get daily summary (grouped by date)
     */
    public function summary()
    {
        // Get filter parameters
        $filterBulan = request()->input('bulan');
        $filterDepartemen = request()->input('departemen');
        $filterKaryawan = request()->input('karyawan');
        
        // Get all dummy data
        $allDummyData = $this->getAllDummyData();
        
        // Apply filters
        $filteredData = $allDummyData;
        
        if (!empty($filterBulan)) {
            $filteredData = array_filter($filteredData, function($item) use ($filterBulan) {
                return isset($item['bulan']) && $item['bulan'] === $filterBulan;
            });
        }
        
        if (!empty($filterDepartemen)) {
            $filteredData = array_filter($filteredData, function($item) use ($filterDepartemen) {
                return isset($item['departemen']) && $item['departemen'] === $filterDepartemen;
            });
        }
        
        if (!empty($filterKaryawan)) {
            $filteredData = array_filter($filteredData, function($item) use ($filterKaryawan) {
                return isset($item['nik']) && $item['nik'] === $filterKaryawan;
            });
        }
        
        // Group by date
        $groupedByDate = [];
        foreach ($filteredData as $record) {
            $date = $record['tanggal_pull'];
            
            if (!isset($groupedByDate[$date])) {
                $groupedByDate[$date] = [
                    'tanggal' => $date,
                    'tanggal_iso' => $this->convertToISO($date),
                    'total_records' => 0,
                    'shifts' => []
                ];
            }
            
            $groupedByDate[$date]['total_records']++;
            
            // Count shifts
            $shift = $record['shift_code'];
            if (!isset($groupedByDate[$date]['shifts'][$shift])) {
                $groupedByDate[$date]['shifts'][$shift] = 0;
            }
            $groupedByDate[$date]['shifts'][$shift]++;
        }
        
        // Convert to array and sort by date
        $summary = array_values($groupedByDate);
        usort($summary, function($a, $b) {
            $dateA = str_replace('/', '-', $a['tanggal']);
            $dateB = str_replace('/', '-', $b['tanggal']);
            $partsA = explode('-', $dateA);
            $partsB = explode('-', $dateB);
            
            // Convert dd-mm-yyyy to timestamp-comparable format
            $timeA = $partsA[2] . $partsA[1] . $partsA[0];
            $timeB = $partsB[2] . $partsB[1] . $partsB[0];
            
            return strcmp($timeA, $timeB);
        });
        
        return response()->json([
            'success' => true,
            'data' => $summary,
            'total_days' => count($summary),
            'total_records' => count($filteredData),
            'filters' => [
                'bulan' => $filterBulan ?: 'Semua',
                'departemen' => $filterDepartemen ?: 'Semua',
                'karyawan' => $filterKaryawan ?: 'Semua'
            ]
        ]);
    }
    
    /**
     * Get detail data for a specific date
     */
    public function detail()
    {
        $tanggal = request()->input('tanggal'); // Format: dd/mm/yyyy
        
        if (empty($tanggal)) {
            return response()->json([
                'success' => false,
                'message' => 'Tanggal tidak boleh kosong'
            ]);
        }
        
        // Get all dummy data
        $allDummyData = $this->getAllDummyData();
        
        // Filter by date
        $detailData = array_filter($allDummyData, function($item) use ($tanggal) {
            return $item['tanggal_pull'] === $tanggal;
        });
        
        $detailData = array_values($detailData);
        
        return response()->json([
            'success' => true,
            'data' => $detailData,
            'total' => count($detailData),
            'tanggal' => $tanggal
        ]);
    }
    
    /**
     * Helper: Get all dummy data
     */
    private function getAllDummyData()
    {
        return [
            [
                'id_pull' => 1,
                'tanggal_pull' => '03/02/2026',
                'shift_code' => 'S1c',
                'shift_name' => 'Shift 1c',
                'nik' => '14588',
                'nama' => 'Ahmad Budiman',
                'departemen' => 'Produksi',
                'bulan' => '2026-02',
                'jam_masuk' => '07:30',
                'scan_masuk' => '07:26',
                'terlambat' => '00:00',
                'jam_keluar' => '15:30',
                'scan_keluar' => '15:00',
                'pulang_cepat' => '00:30',
                'istirahat1_scan1' => '11:00',
                'istirahat1_scan2' => '11:22',
                'istirahat2_scan1' => '',
                'istirahat2_scan2' => '',
                'durasi' => '08:15'
            ],
            [
                'id_pull' => 2,
                'tanggal_pull' => '03/02/2026',
                'shift_code' => 'S2c',
                'shift_name' => 'Shift 2b',
                'nik' => '74114',
                'nama' => 'Siti Nurhaliza',
                'departemen' => 'Produksi',
                'bulan' => '2026-02',
                'jam_masuk' => '15:30',
                'scan_masuk' => '15:19',
                'terlambat' => '00:11',
                'jam_keluar' => '23:30',
                'scan_keluar' => '23:30',
                'pulang_cepat' => '00:00',
                'istirahat1_scan1' => '17:51',
                'istirahat1_scan2' => '18:13',
                'istirahat2_scan1' => '21:22',
                'istirahat2_scan2' => '21:35',
                'durasi' => '07:38'
            ],
            [
                'id_pull' => 3,
                'tanggal_pull' => '03/02/2026',
                'shift_code' => 'S1c',
                'shift_name' => 'Shift 1c',
                'nik' => '00415',
                'nama' => 'Budi Santoso',
                'departemen' => 'Produksi',
                'bulan' => '2026-02',
                'jam_masuk' => '07:30',
                'scan_masuk' => '07:35',
                'terlambat' => '00:05',
                'jam_keluar' => '15:30',
                'scan_keluar' => '15:32',
                'pulang_cepat' => '00:00',
                'istirahat1_scan1' => '11:04',
                'istirahat1_scan2' => '11:38',
                'istirahat2_scan1' => '',
                'istirahat2_scan2' => '',
                'durasi' => '07:46'
            ],
            [
                'id_pull' => 4,
                'tanggal_pull' => '04/02/2026',
                'shift_code' => 'S1c',
                'shift_name' => 'Shift 1c',
                'nik' => '95663',
                'nama' => 'Fitri Handayani',
                'departemen' => 'Produksi',
                'bulan' => '2026-02',
                'jam_masuk' => '07:30',
                'scan_masuk' => '07:26',
                'terlambat' => '00:00',
                'jam_keluar' => '15:30',
                'scan_keluar' => '15:31',
                'pulang_cepat' => '00:00',
                'istirahat1_scan1' => '11:24',
                'istirahat1_scan2' => '11:56',
                'istirahat2_scan1' => '',
                'istirahat2_scan2' => '',
                'durasi' => '07:39'
            ],
            [
                'id_pull' => 5,
                'tanggal_pull' => '05/02/2026',
                'shift_code' => 'S1c',
                'shift_name' => 'Shift 1c',
                'nik' => '14588',
                'nama' => 'Ahmad Budiman',
                'departemen' => 'Produksi',
                'bulan' => '2026-02',
                'jam_masuk' => '07:30',
                'scan_masuk' => '07:35',
                'terlambat' => '00:05',
                'jam_keluar' => '15:30',
                'scan_keluar' => '15:30',
                'pulang_cepat' => '00:00',
                'istirahat1_scan1' => '11:00',
                'istirahat1_scan2' => '11:22',
                'istirahat2_scan1' => '',
                'istirahat2_scan2' => '',
                'durasi' => '08:00'
            ],
            [
                'id_pull' => 6,
                'tanggal_pull' => '06/02/2026',
                'shift_code' => 'S3c',
                'shift_name' => 'Shift 3b',
                'nik' => '78332',
                'nama' => 'Dewi Kusuma',
                'departemen' => 'Produksi',
                'bulan' => '2026-02',
                'jam_masuk' => '23:30',
                'scan_masuk' => '23:23',
                'terlambat' => '00:00',
                'jam_keluar' => '07:30',
                'scan_keluar' => '07:35',
                'pulang_cepat' => '00:00',
                'istirahat1_scan1' => '02:33',
                'istirahat1_scan2' => '02:59',
                'istirahat2_scan1' => '',
                'istirahat2_scan2' => '',
                'durasi' => '07:46'
            ],
            [
                'id_pull' => 7,
                'tanggal_pull' => '06/02/2026',
                'shift_code' => 'S3c',
                'shift_name' => 'Shift 3b',
                'nik' => '14755',
                'nama' => 'Gunawan Wibowo',
                'departemen' => 'Produksi',
                'bulan' => '2026-02',
                'jam_masuk' => '23:30',
                'scan_masuk' => '23:20',
                'terlambat' => '00:00',
                'jam_keluar' => '07:30',
                'scan_keluar' => '07:30',
                'pulang_cepat' => '00:00',
                'istirahat1_scan1' => '02:30',
                'istirahat1_scan2' => '03:00',
                'istirahat2_scan1' => '',
                'istirahat2_scan2' => '',
                'durasi' => '07:40'
            ],
            [
                'id_pull' => 8,
                'tanggal_pull' => '10/02/2026',
                'shift_code' => 'S1c',
                'shift_name' => 'Shift 1c',
                'nik' => '95663',
                'nama' => 'Fitri Handayani',
                'departemen' => 'Produksi',
                'bulan' => '2026-02',
                'jam_masuk' => '07:30',
                'scan_masuk' => '07:27',
                'terlambat' => '00:00',
                'jam_keluar' => '15:30',
                'scan_keluar' => '15:31',
                'pulang_cepat' => '00:00',
                'istirahat1_scan1' => '11:24',
                'istirahat1_scan2' => '11:56',
                'istirahat2_scan1' => '',
                'istirahat2_scan2' => '',
                'durasi' => '07:39'
            ],
            [
                'id_pull' => 9,
                'tanggal_pull' => '10/02/2026',
                'shift_code' => 'S1c',
                'shift_name' => 'Shift 1c',
                'nik' => '14588',
                'nama' => 'Ahmad Budiman',
                'departemen' => 'Produksi',
                'bulan' => '2026-02',
                'jam_masuk' => '07:30',
                'scan_masuk' => '07:25',
                'terlambat' => '00:00',
                'jam_keluar' => '15:30',
                'scan_keluar' => '15:35',
                'pulang_cepat' => '00:00',
                'istirahat1_scan1' => '11:00',
                'istirahat1_scan2' => '11:30',
                'istirahat2_scan1' => '',
                'istirahat2_scan2' => '',
                'durasi' => '07:40'
            ],
            [
                'id_pull' => 10,
                'tanggal_pull' => '11/02/2026',
                'shift_code' => 'S1c',
                'shift_name' => 'Shift 1c',
                'nik' => '14755',
                'nama' => 'Gunawan Wibowo',
                'departemen' => 'Produksi',
                'bulan' => '2026-02',
                'jam_masuk' => '07:30',
                'scan_masuk' => '06:46',
                'terlambat' => '00:00',
                'jam_keluar' => '15:30',
                'scan_keluar' => '15:31',
                'pulang_cepat' => '00:00',
                'istirahat1_scan1' => '11:00',
                'istirahat1_scan2' => '11:31',
                'istirahat2_scan1' => '',
                'istirahat2_scan2' => '',
                'durasi' => '08:14'
            ],
            [
                'id_pull' => 11,
                'tanggal_pull' => '12/02/2026',
                'shift_code' => 'S2c',
                'shift_name' => 'Shift 2b',
                'nik' => '41220',
                'nama' => 'Hani Rahmawati',
                'departemen' => 'QC',
                'bulan' => '2026-02',
                'jam_masuk' => '15:30',
                'scan_masuk' => '15:26',
                'terlambat' => '00:00',
                'jam_keluar' => '23:30',
                'scan_keluar' => '23:34',
                'pulang_cepat' => '00:00',
                'istirahat1_scan1' => '18:32',
                'istirahat1_scan2' => '19:06',
                'istirahat2_scan1' => '21:34',
                'istirahat2_scan2' => '21:48',
                'durasi' => '07:32'
            ]
        ];
    }
    
    /**
     * Helper: Convert dd/mm/yyyy to ISO format
     */
    private function convertToISO($dateStr)
    {
        $parts = explode('/', $dateStr);
        if (count($parts) === 3) {
            return $parts[2] . '-' . $parts[1] . '-' . $parts[0];
        }
        return $dateStr;
    }
}
