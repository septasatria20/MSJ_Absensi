<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SetTukarJadwalAuth extends Seeder
{
    public function run(): void
    {
        echo "Setting up Tukar Jadwal authentication...\n";
        
        // Check if auth entry exists
        $exists = DB::table('sys_auth')
            ->where('gmenu', 'transc')
            ->where('dmenu', 'trstuk')
            ->exists();
        
        if ($exists) {
            // Update existing
            DB::table('sys_auth')
                ->where('gmenu', 'transc')
                ->where('dmenu', 'trstuk')
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
            echo "✓ Updated existing sys_auth entries for trstuk\n";
        } else {
            // Insert new for common roles
            $roles = ['hr', 'admin', 'superadmin'];
            foreach ($roles as $role) {
                DB::table('sys_auth')->insert([
                    'gmenu' => 'transc',
                    'dmenu' => 'trstuk',
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
            echo "✓ Created sys_auth entries for trstuk (hr, admin, superadmin)\n";
        }
        
        echo "\nTukar Jadwal authentication configured successfully!\n";
        echo "Roles with full access: hr, admin, superadmin\n";
    }
}
