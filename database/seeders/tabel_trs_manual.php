<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tabel_trs_manual extends Seeder
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

        DB::table('sys_dmenu')
            ->where('dmenu', 'trstuk')
            ->update([
                'urut' => 11,
                'layout' => 'manual',
                'show' => '1',
                'isactive' => '1',
            ]);

        DB::table('sys_dmenu')
            ->where('dmenu', 'trsmis')
            ->update([
                'urut' => 12,
                'layout' => 'manual',
                'show' => '1',
                'isactive' => '1',
            ]);

        $menuExists = DB::table('sys_dmenu')
            ->where('dmenu', 'trssp')
            ->exists();

        if (!$menuExists) {
            DB::table('sys_dmenu')->insert([
                'gmenu' => 'transc',
                'dmenu' => 'trssp',
                'name' => 'Kirim SP',
                'url' => 'trssp',
                'icon' => 'fas fa-envelope',
                'layout' => 'manual',
                'tabel' => 'trs_kirim_sp',
                'sub' => null,
                'urut' => 13,
                'show' => '1',
                'isactive' => '1',
                'js' => '0',
            ]);
        } else {
            DB::table('sys_dmenu')
                ->where('dmenu', 'trssp')
                ->update([
                    'urut' => 13,
                    'layout' => 'manual',
                    'show' => '1',
                    'isactive' => '1',
                ]);
        }

        $authExists = DB::table('sys_auth')
            ->where('gmenu', 'transc')
            ->where('dmenu', 'trssp')
            ->exists();

        if ($authExists) {
            DB::table('sys_auth')
                ->where('gmenu', 'transc')
                ->where('dmenu', 'trssp')
                ->update([
                    'add' => '1',
                    'edit' => '1',
                    'delete' => '1',
                    'approval' => '1',
                    'print' => '1',
                    'excel' => '1',
                    'pdf' => '1',
                    'rules' => '1',
                    'isactive' => '1',
                ]);
        } else {
            DB::table('sys_auth')->insert([
                'gmenu' => 'transc',
                'dmenu' => 'trssp',
                'idroles' => 'hr',
                'add' => '1',
                'edit' => '1',
                'delete' => '1',
                'approval' => '1',
                'print' => '1',
                'excel' => '1',
                'pdf' => '1',
                'rules' => '1',
                'isactive' => '1',
            ]);
        }
    }
}