<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SetDataMissingManual extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        echo "Updating Data Missing layout to 'manual'...\n";
        
        $updated = DB::table('sys_dmenu')
            ->where('dmenu', 'trsmis')
            ->update([
                'layout' => 'manual',
                'show' => 1,
                'isactive' => 1
            ]);
            
        if ($updated > 0) {
            echo "✓ Data Missing layout updated to 'manual'\n";
            
            // Check result
            $menu = DB::table('sys_dmenu')->where('dmenu', 'trsmis')->first();
            echo "  - URL: {$menu->url}\n";
            echo "  - Layout: {$menu->layout}\n";
            echo "  - Show: {$menu->show}\n";
            echo "  - Active: {$menu->isactive}\n";
        } else {
            echo "✗ No records updated\n";
        }
    }
}
