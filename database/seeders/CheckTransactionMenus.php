<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CheckTransactionMenus extends Seeder
{
    public function run(): void
    {
        echo "\n=== CHECKING ALL TRANSACTION MENUS ===\n\n";

        $transMenus = DB::table('sys_dmenu')
            ->where('gmenu', 'transc')
            ->orderBy('urut')
            ->get();

        foreach ($transMenus as $menu) {
            echo "Menu: {$menu->name}\n";
            echo "  - dmenu: {$menu->dmenu}\n";
            echo "  - url: {$menu->url}\n";
            echo "  - layout: {$menu->layout}\n";
            echo "  - tabel: {$menu->tabel}\n";
            echo "  - show: {$menu->show}\n";
            echo "  - active: {$menu->isactive}\n";
            
            // Check auth
            $auth = DB::table('sys_auth')
                ->where(['gmenu' => 'transc', 'dmenu' => $menu->dmenu, 'idroles' => 'hr'])
                ->first();
            
            if ($auth) {
                echo "  - Auth HR: isactive = {$auth->isactive}\n";
            } else {
                echo "  - Auth HR: NOT FOUND\n";
            }
            
            // Check view based on layout
            if ($menu->layout != 'manual') {
                $viewPath = "transc.auto.list";
                echo "  - Expected View: resources/views/{$viewPath}.blade.php\n";
            } else {
                $viewPath = "transc.{$menu->url}";
                echo "  - Expected View: resources/views/{$viewPath}.blade.php\n";
            }
            
            echo "\n";
        }

        echo "=== RECOMMENDATION ===\n";
        echo "Pull Finger should use layout 'standr' (like Tukar Jadwal & Data Missing)\n";
        echo "This will use: standr.auto.list view + StandrController\n\n";
    }
}
