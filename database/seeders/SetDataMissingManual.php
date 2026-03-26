<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class set_trs_data_missing_manual extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sys_dmenu')
            ->where('dmenu', 'trsmis')
            ->update([
                'urut' => 12,
                'layout' => 'manual',
                'show' => 1,
                'isactive' => 1
            ]);
    }
}
