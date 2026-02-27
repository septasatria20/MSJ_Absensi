<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FixTransactionMenuOrder extends Seeder
{
    public function run(): void
    {
        echo "Fixing Transaction Menu Order...\n\n";
        
        // Update urutan menu transaksi sesuai permintaan
        // Urutan: Pull Finger (10), Tukar Jadwal (11), Data Missing (12), Kirim SP (13)
        
        DB::table('sys_dmenu')->where('dmenu', 'trspul')->update([
            'urut' => 10,
            'show' => '1',
            'isactive' => '1'
        ]);
        
        DB::table('sys_dmenu')->where('dmenu', 'trstuk')->update([
            'urut' => 11,
            'show' => '1',
            'isactive' => '1'
        ]);
        
        DB::table('sys_dmenu')->where('dmenu', 'trsmis')->update([
            'urut' => 12,
            'show' => '1',
            'isactive' => '1'
        ]);
        
        DB::table('sys_dmenu')->where('dmenu', 'trssp')->update([
            'urut' => 13,
            'show' => '1',
            'isactive' => '1'
        ]);
        
        echo "✓ Transaction menu order updated:\n";
        
        // Verify
        $menus = DB::table('sys_dmenu')
            ->where('gmenu', 'transc')
            ->whereIn('dmenu', ['trspul', 'trstuk', 'trsmis', 'trssp'])
            ->orderBy('urut')
            ->get(['dmenu', 'name', 'urut', 'show', 'isactive']);
            
        foreach ($menus as $menu) {
            $visible = $menu->show && $menu->isactive ? '✓ VISIBLE' : '✗ HIDDEN';
            echo "  {$menu->urut}. {$menu->name} ({$menu->dmenu}) - {$visible}\n";
        }
        
        echo "\n✓ Done! Refresh browser to see changes.\n";
    }
}
