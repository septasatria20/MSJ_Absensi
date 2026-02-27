<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class TrsspController extends Controller
{
    // Display Kirim SP Page
    public function index($data)
    {
        return view('transc.trssp.list', $data);
    }

    // Get SP History List (AJAX with Pagination)
    public function ajax($data = [])
    {
        $page = request()->input('page', 1);
        $perPage = 10;
        $nik = request()->input('nik', '');

        // Dummy data - nanti akan diganti dengan query database
        $allData = [
            [
                'id' => 1,
                'nik' => '169987',
                'nama' => 'Ahmad Fauzi',
                'departemen' => 'Produksi',
                'mangkir' => 3,
                'izin' => 1,
                'cuti' => 0,
                'telat' => 0,
                'istirahat' => 0,
                'overtime' => 0,
                'pulang_cepat' => 0,
                'tugas' => 1,
                'sp_level' => 'SP 2',
                'tanggal_sp' => '2026-02-15',
                'status' => 'sent', // sent, pending, completed
                'wa_sent' => true,
                'email_sent' => false
            ],
            [
                'id' => 2,
                'nik' => '235578',
                'nama' => 'Citra Dewi',
                'departemen' => 'Warehouse',
                'mangkir' => 5,
                'izin' => 0,
                'cuti' => 2,
                'telat' => 0,
                'istirahat' => 0,
                'overtime' => 0,
                'pulang_cepat' => 0,
                'tugas' => 0,
                'sp_level' => 'SP 2',
                'tanggal_sp' => '2026-02-14',
                'status' => 'sent',
                'wa_sent' => true,
                'email_sent' => false
            ],
            [
                'id' => 3,
                'nik' => '099744',
                'nama' => 'Gita Maharani',
                'departemen' => 'QC',
                'mangkir' => 2,
                'izin' => 1,
                'cuti' => 1,
                'telat' => 0,
                'istirahat' => 0,
                'overtime' => 0,
                'pulang_cepat' => 0,
                'tugas' => 0,
                'sp_level' => 'SP 1',
                'tanggal_sp' => '2026-02-13',
                'status' => 'sent',
                'wa_sent' => false,
                'email_sent' => false
            ],
            [
                'id' => 4,
                'nik' => '099744',
                'nama' => 'Hari Purnomo',
                'departemen' => 'Admin',
                'mangkir' => 4,
                'izin' => 0,
                'cuti' => 0,
                'telat' => 0,
                'istirahat' => 0,
                'overtime' => 0,
                'pulang_cepat' => 0,
                'tugas' => 0,
                'sp_level' => 'SP 2',
                'tanggal_sp' => '2026-02-12',
                'status' => 'sent',
                'wa_sent' => false,
                'email_sent' => false
            ],
            [
                'id' => 5,
                'nik' => '099744',
                'nama' => 'Indah Permata',
                'departemen' => 'Produksi',
                'mangkir' => 1,
                'izin' => 1,
                'cuti' => 1,
                'telat' => 0,
                'istirahat' => 0,
                'overtime' => 0,
                'pulang_cepat' => 0,
                'tugas' => 0,
                'sp_level' => 'SP 3',
                'tanggal_sp' => '2026-02-11',
                'status' => 'pending',
                'wa_sent' => false,
                'email_sent' => false
            ],
            [
                'id' => 6,
                'nik' => '099744',
                'nama' => 'Joko Widodo',
                'departemen' => 'Warehouse',
                'mangkir' => 3,
                'izin' => 2,
                'cuti' => 0,
                'telat' => 0,
                'istirahat' => 0,
                'overtime' => 0,
                'pulang_cepat' => 0,
                'tugas' => 0,
                'sp_level' => 'SP 1',
                'tanggal_sp' => '2026-02-10',
                'status' => 'sent',
                'wa_sent' => true,
                'email_sent' => false
            ],
            [
                'id' => 7,
                'nik' => '415597',
                'nama' => 'Septa Satria',
                'departemen' => 'MIS',
                'mangkir' => 2,
                'izin' => 1,
                'cuti' => 0,
                'telat' => 0,
                'istirahat' => 0,
                'overtime' => 0,
                'pulang_cepat' => 0,
                'tugas' => 1,
                'sp_level' => 'SP 1',
                'tanggal_sp' => '2026-02-09',
                'status' => 'completed',
                'wa_sent' => true,
                'email_sent' => true
            ],
            [
                'id' => 8,
                'nik' => '445178',
                'nama' => 'Sri Mulyani',
                'departemen' => 'MIS',
                'mangkir' => 6,
                'izin' => 0,
                'cuti' => 1,
                'telat' => 0,
                'istirahat' => 0,
                'overtime' => 0,
                'pulang_cepat' => 0,
                'tugas' => 0,
                'sp_level' => 'SP 3',
                'tanggal_sp' => '2026-02-08',
                'status' => 'sent',
                'wa_sent' => true,
                'email_sent' => false
            ],
        ];

        // Filter by NIK
        if ($nik) {
            $allData = array_filter($allData, function($item) use ($nik) {
                return $item['nik'] === $nik;
            });
            $allData = array_values($allData);
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

    // Get Karyawan List (AJAX for autocomplete)
    public function getkaryawan($data = [])
    {
        $query = request()->input('query', '');

        // Reuse karyawan data from TrstukController
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

    // Update SP Level
    public function updatesp($data = [])
    {
        $id = request()->input('id');
        $sp_level = request()->input('sp_level');
        
        // TODO: Update SP level in database
        
        return response()->json([
            'success' => true,
            'message' => 'SP Level berhasil diupdate ke ' . $sp_level
        ]);
    }

    // Generate and Print SP
    public function cetaksp($data = [])
    {
        $id = request()->input('id');
        
        // TODO: Generate PDF SP
        
        return response()->json([
            'success' => true,
            'message' => 'Surat Peringatan berhasil dicetak',
            'pdf_url' => '/storage/sp/SP-' . $id . '.pdf'
        ]);
    }

    // Send SP via WhatsApp or Email
    public function hubungi($data = [])
    {
        $id = request()->input('id');
        $method = request()->input('method'); // 'whatsapp' or 'email'
        
        // TODO: Implement actual sending via WhatsApp API or Email
        
        if ($method === 'whatsapp') {
            // WhatsApp API integration
            return response()->json([
                'success' => true,
                'message' => 'Surat Peringatan berhasil dikirim via WhatsApp'
            ]);
        } else if ($method === 'email') {
            // Email sending
            return response()->json([
                'success' => true,
                'message' => 'Surat Peringatan berhasil dikirim via Email'
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Metode pengiriman tidak valid'
        ]);
    }

    // Mark SP as Completed
    public function selesai($data = [])
    {
        $id = request()->input('id');
        
        // TODO: Update status in database to 'completed'
        // This will move the record to reports
        
        return response()->json([
            'success' => true,
            'message' => 'SP berhasil ditandai selesai dan akan dipindahkan ke laporan'
        ]);
    }
}
