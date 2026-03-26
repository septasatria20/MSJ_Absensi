<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class set_trs_pull_finger_manual extends Seeder
{
    public function run(): void
    {
        DB::table('sys_dmenu')
            ->where('dmenu', 'trspul')
            ->update([
                'layout' => 'manual',
                'urut' => 10,
                'show' => '1',
                'isactive' => '1',
                'updated_at' => now(),
            ]);
    }
}
