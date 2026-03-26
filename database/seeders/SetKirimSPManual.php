<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class set_trs_kirim_sp_manual extends Seeder
{
    public function run(): void
    {
        // Check if menu exists in sys_dmenu
        $menuExists = DB::table('sys_dmenu')
            ->where('dmenu', 'trssp')
            ->exists();
        
        if (!$menuExists) {
            // Insert new menu
            DB::table('sys_dmenu')->insert([
                'gmenu' => 'transc',
                'dmenu' => 'trssp',
                'name' => 'Kirim SP',
                'url' => 'trssp',
                'icon' => 'fas fa-envelope',
                'layout' => 'manual',
                'tabel' => 'trs_kirim_sp',
                'sub' => null,
                'urut' => 13,
                'show' => '1',
                'isactive' => '1',
                'js' => '0'
            ]);
        } else {
            // Update existing menu
            DB::table('sys_dmenu')
                ->where('dmenu', 'trssp')
                ->update([
                    'urut' => 13,
                    'layout' => 'manual',
                    'show' => '1',
                    'isactive' => '1'
                ]);
        }
        
        // Setup sys_auth
        $authExists = DB::table('sys_auth')
            ->where('gmenu', 'transc')
            ->where('dmenu', 'trssp')
            ->exists();
        
        if ($authExists) {
            DB::table('sys_auth')
                ->where('gmenu', 'transc')
                ->where('dmenu', 'trssp')
                ->update([
                    'add' => '1',
                    'edit' => '1',
                    'delete' => '1',
                    'approval' => '1',
                    'print' => '1',
                    'excel' => '1',
                    'pdf' => '1',
                    'rules' => '1',
                    'isactive' => '1'
                ]);
        } else {
            // Create auth entries only for hr role (which exists)
            $roles = ['hr']; // Only hr for now, can add more later
            foreach ($roles as $role) {
                DB::table('sys_auth')->insert([
                    'gmenu' => 'transc',
                    'dmenu' => 'trssp',
                    'idroles' => $role,
                    'add' => '1',
                    'edit' => '1',
                    'delete' => '1',
                    'approval' => '1',
                    'print' => '1',
                    'excel' => '1',
                    'pdf' => '1',
                    'rules' => '1',
                    'isactive' => '1'
                ]);
            }
        }
    }
}
