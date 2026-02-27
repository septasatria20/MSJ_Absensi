<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComparePullFingerConfig extends Seeder
{
    public function run(): void
    {
        echo "\n=== COMPARE MENU CONFIGS ===\n\n";
        
        // Get Tukar Jadwal (working)
        echo "TUKAR JADWAL (Working):\n";
        $tukjad = DB::table('sys_dmenu')->where('dmenu', 'trstuk')->first();
        if ($tukjad) {
            foreach ($tukjad as $key => $val) {
                if (!empty($val) && $val != '0') {
                    echo "  {$key}: {$val}\n";
                }
            }
        }
        
        echo "\n" . str_repeat("-", 50) . "\n\n";
        
        // Get Pull Finger (error)
        echo "PULL FINGER (Error):\n";
        $pullfinger = DB::table('sys_dmenu')->where('dmenu', 'trspul')->first();
        if ($pullfinger) {
            foreach ($pullfinger as $key => $val) {
                if (!empty($val) && $val != '0') {
                    echo "  {$key}: {$val}\n";
                }
            }
        }
        
        echo "\n" . str_repeat("-", 50) . "\n\n";
        
        // Show differences
        echo "MISSING IN PULL FINGER:\n";
        if ($tukjad && $pullfinger) {
            foreach ($tukjad as $key => $val) {
                if (!empty($val) && $val != '0') {
                    $pullVal = $pullfinger->$key ?? '';
                    if (empty($pullVal) || $pullVal == '0') {
                        echo "  - {$key}: '{$val}' (Tukar Jadwal has this)\n";
                    }
                }
            }
        }
        
        echo "\n";
    }
}
