<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivatePullFingerDataMissing extends Seeder
{
    public function run(): void
    {
        echo "\n=== ACTIVATE PULL FINGER & DATA MISSING FOR HR ===\n\n";
        
        // Pull Finger
        echo "1. Pull Finger (trspul):\n";
        $exists = DB::table('sys_auth')
            ->where('dmenu', 'trspul')
            ->where('idroles', 'hr')
            ->exists();
        
        if ($exists) {
            DB::table('sys_auth')
                ->where('dmenu', 'trspul')
                ->where('idroles', 'hr')
                ->update([
                    'add' => '1',
                    'edit' => '1',
                    'delete' => '1',
                    'approval' => '1',
                    'isactive' => '1',
                ]);
            echo "   ✓ Updated existing auth\n";
        } else {
            DB::table('sys_auth')->insert([
                'gmenu' => 'transc',
                'dmenu' => 'trspul',
                'idroles' => 'hr',
                'add' => '1',
                'edit' => '1',
                'delete' => '1',
                'approval' => '1',
                'value' => '1',
                'print' => '1',
                'excel' => '1',
                'pdf' => '1',
                'isactive' => '1',
            ]);
            echo "   ✓ Created new auth\n";
        }
        
        // Data Missing
        echo "\n2. Data Missing (trsmis):\n";
        $exists = DB::table('sys_auth')
            ->where('dmenu', 'trsmis')
            ->where('idroles', 'hr')
            ->exists();
        
        if ($exists) {
            DB::table('sys_auth')
                ->where('dmenu', 'trsmis')
                ->where('idroles', 'hr')
                ->update([
                    'add' => '1',
                    'edit' => '1',
                    'delete' => '1',
                    'approval' => '1',
                    'isactive' => '1',
                ]);
            echo "   ✓ Updated existing auth\n";
        } else {
            DB::table('sys_auth')->insert([
                'gmenu' => 'transc',
                'dmenu' => 'trsmis',
                'idroles' => 'hr',
                'add' => '1',
                'edit' => '1',
                'delete' => '1',
                'approval' => '1',
                'value' => '1',
                'print' => '1',
                'excel' => '1',
                'pdf' => '1',
                'isactive' => '1',
            ]);
            echo "   ✓ Created new auth\n";
        }
        
        // Verify all 3 menus
        echo "\n=== VERIFICATION ===\n\n";
        
        $menus = [
            ['dmenu' => 'trstuk', 'name' => 'Tukar Jadwal'],
            ['dmenu' => 'trspul', 'name' => 'Pull Finger'],
            ['dmenu' => 'trsmis', 'name' => 'Data Missing'],
        ];
        
        foreach ($menus as $menu) {
            $auth = DB::table('sys_auth')
                ->where('dmenu', $menu['dmenu'])
                ->where('idroles', 'hr')
                ->first();
            
            if ($auth && $auth->isactive == '1') {
                echo "✓ {$menu['name']}: ACTIVE (add={$auth->add}, edit={$auth->edit})\n";
            } else {
                echo "✗ {$menu['name']}: INACTIVE or NOT FOUND\n";
            }
        }
        
        echo "\n=== DONE - Please refresh browser (Ctrl+F5) ===\n\n";
    }
}
