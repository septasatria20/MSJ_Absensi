<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SetTukarJadwalManual extends Seeder
{
    public function run(): void
    {
        echo "Setting Tukar Jadwal layout to manual...\n";
        
        DB::table('sys_dmenu')
            ->where('dmenu', 'trstuk')
            ->update([
                'layout' => 'manual',
                'show' => '1',
                'isactive' => '1'
            ]);
        
        echo "✓ Tukar Jadwal layout updated to 'manual'\n";
        echo "✓ Menu visibility enabled (show=1, isactive=1)\n";
        echo "\nTukar Jadwal is now accessible at /trstuk\n";
    }
}
