<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SetKirimSPManual extends Seeder
{
    public function run(): void
    {
        echo "Setting up Kirim SP menu...\n";
        
        // Check if menu exists in sys_dmenu
        $menuExists = DB::table('sys_dmenu')
            ->where('dmenu', 'trssp')
            ->exists();
        
        if (!$menuExists) {
            // Get the highest urut number for transc group
            $maxUrut = DB::table('sys_dmenu')
                ->where('gmenu', 'transc')
                ->max('urut');
            
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
                'urut' => ($maxUrut ?? 0) + 1,
                'show' => '1',
                'isactive' => '1',
                'js' => '0'
            ]);
            echo "✓ Created new sys_dmenu entry for Kirim SP\n";
        } else {
            // Update existing menu
            DB::table('sys_dmenu')
                ->where('dmenu', 'trssp')
                ->update([
                    'layout' => 'manual',
                    'show' => '1',
                    'isactive' => '1'
                ]);
            echo "✓ Updated existing sys_dmenu entry for Kirim SP\n";
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
            echo "✓ Updated existing sys_auth entries for Kirim SP\n";
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
            echo "✓ Created sys_auth entries for Kirim SP (hr)\n";
        }
        
        echo "\n✅ Kirim SP is now accessible at /trssp\n";
        echo "Role with full access: hr\n";
    }
}
