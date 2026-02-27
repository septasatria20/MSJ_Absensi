<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DebugTransactionAuth extends Seeder
{
    public function run(): void
    {
        echo "\n=== DEBUG TRANSACTION MENU AUTH ===\n\n";
        
        $role = 'hr'; // User yang sedang login
        
        echo "Checking for role: {$role}\n\n";
        
        // Check gmenu transc
        echo "1. Checking gmenu 'transc':\n";
        $gmenu = DB::table('sys_gmenu')->where('gmenu', 'transc')->first();
        if ($gmenu) {
            echo "   ✓ Found: {$gmenu->name} (active: {$gmenu->isactive})\n";
        } else {
            echo "   ✗ NOT FOUND!\n";
        }
        
        // Check dmenu for transc
        echo "\n2. Checking dmenu for 'transc':\n";
        $dmenus = DB::table('sys_dmenu')
            ->where('gmenu', 'transc')
            ->where('isactive', '1')
            ->where('show', '1')
            ->orderBy('urut')
            ->get();
        
        if ($dmenus->count() > 0) {
            echo "   Found {$dmenus->count()} menus:\n";
            foreach ($dmenus as $d) {
                echo "   - {$d->name} (dmenu: {$d->dmenu}, show: {$d->show}, active: {$d->isactive})\n";
            }
        } else {
            echo "   ✗ No dmenus found!\n";
        }
        
        // Check auth for each dmenu
        echo "\n3. Checking sys_auth for role '{$role}':\n";
        $auths = DB::table('sys_dmenu')
            ->join('sys_auth', 'sys_dmenu.dmenu', '=', 'sys_auth.dmenu')
            ->where('sys_auth.idroles', $role)
            ->where('sys_dmenu.isactive', '1')
            ->where('sys_dmenu.show', '1')
            ->where('sys_auth.isactive', '1')
            ->where('sys_dmenu.gmenu', 'transc')
            ->select('sys_dmenu.*')
            ->distinct()
            ->orderBy('sys_dmenu.urut', 'asc')
            ->get();
        
        if ($auths->count() > 0) {
            echo "   ✓ Found {$auths->count()} authorized menus for {$role}:\n";
            foreach ($auths as $a) {
                echo "   - {$a->name} (url: /{$a->url})\n";
            }
        } else {
            echo "   ✗ NO authorized menus found for {$role}!\n";
            echo "\n   Checking raw sys_auth data:\n";
            
            $rawAuth = DB::table('sys_auth')
                ->where('gmenu', 'transc')
                ->where('idroles', $role)
                ->get();
            
            if ($rawAuth->count() > 0) {
                foreach ($rawAuth as $ra) {
                    echo "   - dmenu: {$ra->dmenu}, isactive: {$ra->isactive}\n";
                }
            } else {
                echo "   - No auth records for gmenu=transc, idroles={$role}\n";
            }
        }
        
        // Show exact query used in sidenav
        echo "\n4. Query used in sidenav (simplified):\n";
        echo "   SELECT sys_dmenu.* FROM sys_dmenu\n";
        echo "   JOIN sys_auth ON sys_dmenu.dmenu = sys_auth.dmenu\n";
        echo "   WHERE sys_auth.idroles = '{$role}'\n";
        echo "   AND sys_dmenu.isactive = '1'\n";
        echo "   AND sys_dmenu.show = '1'\n";
        echo "   AND sys_auth.isactive = '1'\n";
        echo "   AND sys_dmenu.gmenu = 'transc'\n";
        echo "   ORDER BY sys_dmenu.urut ASC\n";
        
        echo "\n=== DEBUG COMPLETE ===\n\n";
    }
}
