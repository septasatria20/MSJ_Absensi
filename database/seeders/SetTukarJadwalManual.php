<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class set_trs_tukar_jadwal_manual extends Seeder
{
    public function run(): void
    {
        DB::table('sys_dmenu')
            ->where('dmenu', 'trstuk')
            ->update([
                'urut' => 11,
                'layout' => 'manual',
                'show' => '1',
                'isactive' => '1'
            ]);
    }
}
