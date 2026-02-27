<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CheckPullFingerMenu extends Seeder
{
    public function run(): void
    {
        echo "\n=== CHECK PULL FINGER MENU ===\n\n";

        // Check sys_dmenu
        echo "1. Checking sys_dmenu for Pull Finger:\n";
        $dmenu = DB::table('sys_dmenu')
            ->where(['gmenu' => 'transc', 'dmenu' => 'trspul'])
            ->first();
        
        if ($dmenu) {
            echo "   ✓ Menu found: {$dmenu->name}\n";
            echo "   - URL: {$dmenu->url}\n";
            echo "   - Layout: {$dmenu->layout}\n";
            echo "   - Show: {$dmenu->show}\n";
            echo "   - Active: {$dmenu->isactive}\n";
        } else {
            echo "   ✗ Menu NOT found!\n";
            echo "   Creating menu...\n";
            DB::table('sys_dmenu')->insert([
                'gmenu' => 'transc',
                'dmenu' => 'trspul',
                'urut' => 11,
                'name' => 'Pull Finger',
                'url' => 'trspul',
                'icon' => 'ni-cloud-download-95',
                'tabel' => 'trs_pull_finger',
                'layout' => 'transc',
                'show' => 1,
                'js' => 0,
                'isactive' => 1
            ]);
            echo "   ✓ Menu created!\n";
        }

        // Check sys_auth for HR
        echo "\n2. Checking sys_auth for HR role:\n";
        $authHR = DB::table('sys_auth')
            ->where(['gmenu' => 'transc', 'dmenu' => 'trspul', 'idroles' => 'hr'])
            ->first();
        
        if ($authHR) {
            echo "   ✓ Auth found for HR\n";
            echo "   - Add: {$authHR->add}\n";
            echo "   - Edit: {$authHR->edit}\n";
            echo "   - Delete: {$authHR->delete}\n";
            echo "   - Active: {$authHR->isactive}\n";
            
            if ($authHR->isactive == 0) {
                echo "   ⚠ Auth is INACTIVE! Fixing...\n";
                DB::table('sys_auth')
                    ->where(['gmenu' => 'transc', 'dmenu' => 'trspul', 'idroles' => 'hr'])
                    ->update([
                        'add' => 1,
                        'edit' => 1,
                        'delete' => 1,
                        'approval' => 1,
                        'value' => 1,
                        'print' => 1,
                        'excel' => 1,
                        'pdf' => 1,
                        'isactive' => 1
                    ]);
                echo "   ✓ Auth activated!\n";
            }
        } else {
            echo "   ✗ Auth NOT found for HR!\n";
            echo "   Creating auth...\n";
            DB::table('sys_auth')->insert([
                'gmenu' => 'transc',
                'dmenu' => 'trspul',
                'idroles' => 'hr',
                'add' => 1,
                'edit' => 1,
                'delete' => 1,
                'approval' => 1,
                'value' => 1,
                'print' => 1,
                'excel' => 1,
                'pdf' => 1,
                'isactive' => 1
            ]);
            echo "   ✓ Auth created for HR!\n";
        }

        // Check sys_auth for admins
        echo "\n3. Checking sys_auth for Admin role:\n";
        $authAdmin = DB::table('sys_auth')
            ->where(['gmenu' => 'transc', 'dmenu' => 'trspul', 'idroles' => 'admins'])
            ->first();
        
        if ($authAdmin) {
            echo "   ✓ Auth found for Admin\n";
            echo "   - Active: {$authAdmin->isactive}\n";
            
            if ($authAdmin->isactive == 0) {
                echo "   ⚠ Auth is INACTIVE! Fixing...\n";
                DB::table('sys_auth')
                    ->where(['gmenu' => 'transc', 'dmenu' => 'trspul', 'idroles' => 'admins'])
                    ->update([
                        'add' => 1,
                        'edit' => 1,
                        'delete' => 1,
                        'approval' => 1,
                        'value' => 1,
                        'print' => 1,
                        'excel' => 1,
                        'pdf' => 1,
                        'isactive' => 1
                    ]);
                echo "   ✓ Auth activated!\n";
            }
        } else {
            echo "   ✗ Auth NOT found for Admin!\n";
            echo "   Creating auth...\n";
            DB::table('sys_auth')->insert([
                'gmenu' => 'transc',
                'dmenu' => 'trspul',
                'idroles' => 'admins',
                'add' => 1,
                'edit' => 1,
                'delete' => 1,
                'approval' => 1,
                'value' => 1,
                'print' => 1,
                'excel' => 1,
                'pdf' => 1,
                'isactive' => 1
            ]);
            echo "   ✓ Auth created for Admin!\n";
        }

        // Check all transaction menus
        echo "\n4. All Transaction Menus:\n";
        $transMenus = DB::table('sys_dmenu')
            ->where('gmenu', 'transc')
            ->orderBy('urut')
            ->get();
        
        if ($transMenus->count() > 0) {
            foreach ($transMenus as $menu) {
                echo "   - {$menu->name} (URL: {$menu->url}, Active: {$menu->isactive}, Show: {$menu->show})\n";
            }
        } else {
            echo "   ✗ No transaction menus found!\n";
        }

        echo "\n=== CHECK COMPLETE ===\n";
        echo "\nPlease refresh your browser (Ctrl+F5) and check the Transactions menu.\n\n";
    }
}
