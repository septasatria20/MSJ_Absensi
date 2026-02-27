<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FixPullFingerLayout extends Seeder
{
    public function run(): void
    {
        echo "\n=== FIXING PULL FINGER LAYOUT ===\n\n";

        // Update layout from 'standr' to 'transc'
        $updated = DB::table('sys_dmenu')
            ->where(['gmenu' => 'transc', 'dmenu' => 'trspul'])
            ->update(['layout' => 'transc']);

        if ($updated) {
            echo "✓ Layout updated from 'standr' to 'transc'\n";
            echo "✓ View file location: resources/views/transc/trspul.blade.php\n";
        } else {
            echo "✗ Update failed or record not found\n";
        }

        // Verify
        $menu = DB::table('sys_dmenu')
            ->where(['gmenu' => 'transc', 'dmenu' => 'trspul'])
            ->first();

        if ($menu) {
            echo "\nCurrent Pull Finger Menu Config:\n";
            echo "  - Name: {$menu->name}\n";
            echo "  - URL: {$menu->url}\n";
            echo "  - Layout: {$menu->layout}\n";
            echo "  - Table: {$menu->tabel}\n";
            echo "  - Show: {$menu->show}\n";
            echo "  - Active: {$menu->isactive}\n";
        }

        echo "\n=== FIX COMPLETE ===\n";
        echo "\nNow you can access Pull Finger at: http://127.0.0.1:8001/trspul\n\n";
    }
}
