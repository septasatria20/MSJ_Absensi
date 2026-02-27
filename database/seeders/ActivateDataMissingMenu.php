<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivateDataMissingMenu extends Seeder
{
    public function run(): void
    {
        DB::table('sys_dmenu')
            ->where('dmenu', 'trsmis')
            ->update([
                'show' => 1,
                'isactive' => 1
            ]);
            
        echo "✓ Data Missing menu activated\n";
    }
}
