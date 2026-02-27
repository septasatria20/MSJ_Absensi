<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SetPullFingerManual extends Seeder
{
    public function run(): void
    {
        echo "\n=== SET PULL FINGER TO MANUAL LAYOUT ===\n\n";
        
        // Update to manual
        DB::table('sys_dmenu')
            ->where('dmenu', 'trspul')
            ->update([
                'layout' => 'manual',
                'updated_at' => now(),
            ]);
        
        $menu = DB::table('sys_dmenu')->where('dmenu', 'trspul')->first();
        
        echo "Pull Finger Configuration:\n";
        echo "  dmenu: {$menu->dmenu}\n";
        echo "  gmenu: {$menu->gmenu}\n";
        echo "  url: {$menu->url}\n";
        echo "  tabel: {$menu->tabel}\n";
        echo "  layout: {$menu->layout}\n";
        echo "  show: {$menu->show}\n";
        echo "  isactive: {$menu->isactive}\n";
        
        if ($menu->layout === 'manual') {
            echo "\n✓ Layout set to MANUAL\n";
            echo "\n";
            echo "Expected Route: /trspul\n";
            echo "Expected View: resources/views/transc/trspul.blade.php\n";
            echo "Expected Controller: Custom controller (not StandrController)\n";
        }
        
        echo "\n=== DONE ===\n\n";
    }
}
