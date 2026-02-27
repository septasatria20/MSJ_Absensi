<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CheckMenuStatus extends Seeder
{
    public function run()
    {
        $menus = DB::table('sys_dmenu')
            ->whereIn('dmenu', ['trspul', 'trstuk', 'trsmis', 'trssp'])
            ->orderBy('urut')
            ->get(['dmenu', 'url', 'show', 'isactive', 'urut']);

        echo "\n" . str_repeat('=', 70) . "\n";
        echo "TRANSACTION MENU STATUS CHECK\n";
        echo str_repeat('=', 70) . "\n\n";

        foreach ($menus as $menu) {
            $showStatus = $menu->show == 1 ? '✓ VISIBLE' : '✗ HIDDEN';
            $activeStatus = $menu->isactive == 1 ? '✓ ACTIVE' : '✗ INACTIVE';
            
            echo sprintf(
                "%2d. %-10s (url=%-8s) - show=%d %s | isactive=%d %s\n",
                $menu->urut,
                $menu->dmenu,
                $menu->url,
                $menu->show,
                $showStatus,
                $menu->isactive,
                $activeStatus
            );
        }

        echo "\n" . str_repeat('=', 70) . "\n";
    }
}
