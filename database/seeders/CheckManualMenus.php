<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CheckManualMenus extends Seeder
{
    public function run(): void
    {
        echo "\n=== CHECK MANUAL LAYOUT MENUS ===\n\n";
        
        $manuals = DB::table('sys_dmenu')
            ->where('layout', 'manual')
            ->where('isactive', '1')
            ->get();
        
        echo "Found {$manuals->count()} manual menus:\n\n";
        
        foreach ($manuals as $m) {
            echo "- {$m->name}\n";
            echo "  gmenu: {$m->gmenu}\n";
            echo "  dmenu: {$m->dmenu}\n";
            echo "  url: {$m->url}\n";
            echo "  tabel: {$m->tabel}\n";
            echo "  Expected Controller: " . ucfirst($m->url) . "Controller\n";
            echo "  Expected View: resources/views/{$m->gmenu}/{$m->url}.blade.php\n";
            echo "\n";
        }
    }
}
