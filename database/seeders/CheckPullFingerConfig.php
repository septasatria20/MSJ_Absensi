<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CheckPullFingerConfig extends Seeder
{
    public function run(): void
    {
        echo "\n=== CHECK PULL FINGER CONFIG ===\n\n";
        
        $menu = DB::table('sys_dmenu')->where('dmenu', 'trspul')->first();
        
        if ($menu) {
            echo "Pull Finger Menu Config:\n";
            foreach ($menu as $key => $value) {
                echo "  {$key}: " . ($value ?? 'NULL') . "\n";
            }
        } else {
            echo "Menu not found!\n";
        }
        
        echo "\n=== END ===\n\n";
    }
}
