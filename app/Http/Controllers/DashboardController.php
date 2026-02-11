<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index($data)
    {
        // Check if user has HR role
        $users_rules = $data['users_rules'] ?? [];
        
        if (in_array('hr', $users_rules)) {
            // Get dashboard data for HR
            $dashboardData = $this->getHRDashboardData();
            $data = array_merge($data, $dashboardData);
            $data['url'] = 'pages.dashboard.hr_dashboard';
        }
        
        return view($data['url'], $data);
    }
    
    /**
     * Get dashboard data for HR role
     */
    private function getHRDashboardData()
    {
        // Data dummy untuk dashboard HR
        // Nanti bisa diganti dengan query real dari database
        
        return [
            'total_karyawan' => 400,
            'hadir_hari_ini' => 365,
            'izin_cuti' => 25,
            'mangkir' => 10,
            'terlambat' => 42,
            'shift_pagi' => 180,
            'shift_malam' => 120,
            'non_shift' => 100,
        ];
    }
}
