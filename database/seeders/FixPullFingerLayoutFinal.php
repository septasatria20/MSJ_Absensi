<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FixPullFingerLayoutFinal extends Seeder
{
    public function run(): void
    {
        echo "\n=== FIX PULL FINGER LAYOUT ===\n\n";
        
        // Before
        $before = DB::table('sys_dmenu')->where('dmenu', 'trspul')->first();
        echo "BEFORE:\n";
        echo "  layout: {$before->layout}\n";
        echo "  tabel: {$before->tabel}\n\n";
        
        // Update
        $affected = DB::table('sys_dmenu')
            ->where('dmenu', 'trspul')
            ->update([
                'layout' => 'standr',
                'updated_at' => now(),
            ]);
        
        echo "UPDATE executed (rows affected: {$affected})\n\n";
        
        // After
        $after = DB::table('sys_dmenu')->where('dmenu', 'trspul')->first();
        echo "AFTER:\n";
        echo "  layout: {$after->layout}\n";
        echo "  tabel: {$after->tabel}\n";
        
        if ($after->layout === 'standr') {
            echo "\n✓ FIXED! Layout is now 'standr'\n";
        } else {
            echo "\n✗ FAILED! Layout is still '{$after->layout}'\n";
        }
        
        echo "\n=== DONE ===\n\n";
    }
}
